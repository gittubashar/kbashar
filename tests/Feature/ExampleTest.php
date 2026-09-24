<?php

namespace Tests\Feature;

use App\Models\ContactMessage;
use App\Models\Page;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_public_default_pages_are_available(): void
    {
        $this->get('/')->assertOk()->assertSee('Business technology');
        $this->get('/services')->assertOk()->assertSee('Services built around');
        $this->get('/contact')->assertOk()->assertSee('Let’s talk about what the business needs');
        $this->get('/privacy-policy')->assertOk()->assertSee('Privacy Policy');
        $this->get('/terms-of-service')->assertOk()->assertSee('Terms of Service');
    }

    public function test_five_default_pages_are_protected_system_pages(): void
    {
        $this->assertSame(5, Page::query()->where('is_system', true)->count());
        $this->assertEqualsCanonicalizing(
            ['home', 'services', 'contact', 'privacy-policy', 'terms-of-service'],
            Page::query()->where('is_system', true)->pluck('slug')->all()
        );
    }

    public function test_guests_cannot_open_dashboard(): void
    {
        $this->get('/admin')->assertRedirect('/admin/login');
    }

    public function test_authenticated_administrator_can_open_dashboard(): void
    {
        $this->actingAs(User::query()->first())->get('/admin')->assertOk()->assertSee('Control centre');
        $this->get('/admin/account')->assertOk()->assertSee('Account security');
    }

    public function test_system_page_remains_published_and_unsafe_html_is_removed(): void
    {
        $page = Page::query()->where('slug', 'home')->firstOrFail();

        $this->actingAs(User::query()->first())->put('/admin/pages/home', [
            'title' => $page->title,
            'content' => '<p onclick="alert(1)">Safe copy</p><script>alert(1)</script>',
            'sort_order' => 1,
            'show_in_navigation' => 1,
        ])->assertSessionHasNoErrors();

        $page->refresh();
        $this->assertTrue($page->is_published);
        $this->assertStringNotContainsString('onclick', $page->content);
        $this->assertStringNotContainsString('<script', $page->content);
    }

    public function test_contact_form_stores_a_valid_enquiry(): void
    {
        $this->post('/contact', [
            'name' => 'Example Client',
            'email' => 'client@example.com',
            'service' => 'Web Development',
            'subject' => 'A portfolio project',
            'message' => 'I would like to discuss a new portfolio and business website.',
        ])->assertSessionHasNoErrors()->assertSessionHas('success');

        $this->assertSame(1, ContactMessage::query()->count());
    }
}
