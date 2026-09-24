<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class BusinessContentSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            'hero_eyebrow' => 'Technology partner for growing businesses',
            'hero_title' => 'Business technology, handled end to end.',
            'hero_description' => 'We design, build and manage the digital systems your business needs to operate efficiently, stay secure and grow with confidence.',
            'about_title' => 'One accountable partner across your technology stack.',
            'about_text' => 'Development, infrastructure and digital growth work better when they share one plan. We bring those disciplines together to deliver solutions that are practical, secure and ready to scale.',
        ];

        foreach ($settings as $key => $value) {
            SiteSetting::query()->where('key', $key)->update(['value' => $value]);
        }

        Page::query()->where('slug', 'home')->update([
            'excerpt' => 'Practical technology solutions for businesses that want to operate better, scale confidently and grow online.',
            'content' => '<p>We connect development, infrastructure and digital growth in one accountable technology partnership.</p>',
            'meta_title' => 'K Bashar — Business Technology Solutions',
            'meta_description' => 'Web, software, infrastructure, SEO and digital marketing solutions for modern businesses.',
        ]);

        Page::query()->where('slug', 'services')->update([
            'excerpt' => 'Connected technology services designed around real operational and growth objectives.',
            'content' => '<p>Choose a focused service or combine capabilities into a complete business solution.</p>',
            'meta_title' => 'Business Technology Services — K Bashar',
        ]);

        Page::query()->where('slug', 'contact')->update([
            'excerpt' => 'Tell us what your business needs to build, improve or solve.',
            'content' => '<p>Share a few details about your objectives. We will review your enquiry and respond with a clear next step.</p>',
        ]);
    }
}
