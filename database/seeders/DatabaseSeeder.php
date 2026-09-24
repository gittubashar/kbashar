<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\Project;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        User::query()->updateOrCreate(
            ['email' => env('ADMIN_EMAIL', 'admin@kbashar.local')],
            [
                'name' => env('ADMIN_NAME', 'K Bashar'),
                'password' => env('ADMIN_PASSWORD', 'Admin@12345'),
                'email_verified_at' => now(),
            ]
        );

        $pages = [
            [
                'title' => 'Home', 'slug' => 'home', 'eyebrow' => 'Welcome',
                'excerpt' => 'Practical technology solutions for businesses that want to operate better, scale confidently and grow online.',
                'content' => '<p>We connect development, infrastructure and digital growth in one accountable technology partnership.</p>',
                'meta_title' => 'K Bashar — Business Technology Solutions',
                'meta_description' => 'Web, software, infrastructure, SEO and digital marketing solutions for modern businesses.',
                'sort_order' => 1,
            ],
            [
                'title' => 'Services', 'slug' => 'services', 'eyebrow' => 'What I do',
                'excerpt' => 'Connected technology services designed around real operational and growth objectives.',
                'content' => '<p>Choose a focused service or combine capabilities into a complete business solution.</p>',
                'meta_title' => 'Business Technology Services — K Bashar',
                'meta_description' => 'Business web development, software, networking, server administration, SEO and digital marketing services.',
                'sort_order' => 2,
            ],
            [
                'title' => 'Contact', 'slug' => 'contact', 'eyebrow' => 'Start a conversation',
                'excerpt' => 'Tell us what your business needs to build, improve or solve.',
                'content' => '<p>Share a few details about your objectives. We will review your enquiry and respond with a clear next step.</p>',
                'meta_title' => 'Contact K Bashar',
                'meta_description' => 'Contact K Bashar to discuss web, software, network, server, SEO or digital marketing projects.',
                'sort_order' => 3,
            ],
            [
                'title' => 'Privacy Policy', 'slug' => 'privacy-policy', 'eyebrow' => 'Your privacy matters',
                'excerpt' => 'How this website collects, uses and protects information.',
                'content' => '<h2>Information I collect</h2><p>When you use the contact form, this website stores the details you provide so I can respond to your enquiry.</p><h2>How information is used</h2><p>Your information is used only to communicate with you, provide requested services and improve this website.</p><h2>Data protection</h2><p>Reasonable technical and organisational safeguards are used to protect stored information. Your details are not sold to third parties.</p><h2>Contact</h2><p>If you have a privacy-related question, please use the contact page.</p>',
                'meta_title' => 'Privacy Policy — K Bashar',
                'meta_description' => 'Privacy policy for the K Bashar portfolio website.',
                'sort_order' => 4,
            ],
            [
                'title' => 'Terms of Service', 'slug' => 'terms-of-service', 'eyebrow' => 'Working clearly',
                'excerpt' => 'The terms that apply when using this website and engaging my services.',
                'content' => '<h2>Website use</h2><p>The information on this website is provided for general information and may be updated without notice.</p><h2>Project agreements</h2><p>Project scope, deliverables, timelines, payment terms and support arrangements will be confirmed in a separate written agreement before work begins.</p><h2>Intellectual property</h2><p>Ownership and licensing of project materials will follow the terms agreed for each project.</p><h2>Limitation</h2><p>External links are provided for convenience. I am not responsible for the content or availability of third-party websites.</p>',
                'meta_title' => 'Terms of Service — K Bashar',
                'meta_description' => 'Terms of service for the K Bashar portfolio website.',
                'sort_order' => 5,
            ],
        ];

        foreach ($pages as $page) {
            Page::query()->updateOrCreate(
                ['slug' => $page['slug']],
                array_merge($page, ['is_system' => true, 'is_published' => true, 'show_in_navigation' => true])
            );
        }

        $settings = [
            ['general', 'site_title', 'K Bashar', 'text'],
            ['general', 'site_tagline', 'Technology, built with clarity.', 'text'],
            ['general', 'logo_path', null, 'image'],
            ['general', 'hero_eyebrow', 'Technology partner for growing businesses', 'text'],
            ['general', 'hero_title', 'Business technology, handled end to end.', 'text'],
            ['general', 'hero_description', 'We design, build and manage the digital systems your business needs to operate efficiently, stay secure and grow with confidence.', 'textarea'],
            ['general', 'about_title', 'One accountable partner across your technology stack.', 'text'],
            ['general', 'about_text', 'Development, infrastructure and digital growth work better when they share one plan. We bring those disciplines together to deliver solutions that are practical, secure and ready to scale.', 'textarea'],
            ['contact', 'email', 'hello@kbashar.com', 'email'],
            ['contact', 'phone', '+880 1XXX-XXXXXX', 'text'],
            ['contact', 'location', 'Dhaka, Bangladesh', 'text'],
            ['social', 'github_url', '#', 'url'],
            ['social', 'linkedin_url', '#', 'url'],
            ['social', 'facebook_url', '#', 'url'],
        ];

        foreach ($settings as [$group, $key, $value, $type]) {
            SiteSetting::query()->updateOrCreate(['key' => $key], compact('group', 'value', 'type'));
        }

        $services = [
            ['Web Development', 'web-development', 'code', 'Fast, accessible websites and web applications designed around your goals.', ['Business & portfolio websites', 'Custom web applications', 'E-commerce solutions', 'Maintenance & optimisation']],
            ['Software Development', 'software-development', 'terminal', 'Purpose-built software that turns repetitive processes into dependable workflows.', ['Business management systems', 'API & database integration', 'Workflow automation', 'Ongoing maintenance']],
            ['Network Administration', 'network-administration', 'network', 'Stable, secure networks designed, configured and maintained for daily operations.', ['Network design', 'Router & switch configuration', 'Firewall & security', 'Troubleshooting']],
            ['System & Server Administration', 'server-administration', 'server', 'Reliable Linux and Windows server environments with security and recovery in mind.', ['VPS & cloud setup', 'Web server configuration', 'Monitoring & hardening', 'Backup & recovery']],
            ['Search Engine Optimisation', 'search-engine-optimisation', 'search', 'Technical and content-led SEO that helps the right audience find your business.', ['Technical SEO audit', 'Keyword research', 'On-page optimisation', 'Local SEO']],
            ['Digital Marketing', 'digital-marketing', 'megaphone', 'Practical campaigns that connect creative execution to measurable business outcomes.', ['Social media campaigns', 'Paid advertising', 'Lead generation', 'Performance reporting']],
        ];

        foreach ($services as $index => [$title, $slug, $icon, $summary, $features]) {
            Service::query()->updateOrCreate(
                ['slug' => $slug],
                compact('title', 'icon', 'summary', 'features') + [
                    'description' => $summary, 'is_featured' => true,
                    'is_published' => true, 'sort_order' => $index + 1,
                ]
            );
        }

        $projects = [
            ['Operations Command Centre', 'operations-command-centre', 'Web application', 'A role-based operations dashboard that brings live service data, team tasks and reporting into one focused workspace.', ['Laravel', 'Tailwind CSS', 'MySQL']],
            ['Infrastructure Modernisation', 'infrastructure-modernisation', 'Infrastructure', 'A secure server and network refresh designed to improve uptime, observability and recovery readiness.', ['Linux', 'Nginx', 'Network Security']],
            ['Search Growth System', 'search-growth-system', 'SEO & marketing', 'A technical SEO and content framework built to turn organic visibility into qualified enquiries.', ['Technical SEO', 'Analytics', 'Content Strategy']],
        ];

        foreach ($projects as $index => [$title, $slug, $category, $summary, $technologies]) {
            Project::query()->updateOrCreate(
                ['slug' => $slug],
                compact('title', 'category', 'summary', 'technologies') + [
                    'description' => $summary, 'is_featured' => true,
                    'is_published' => true, 'sort_order' => $index + 1,
                ]
            );
        }
    }
}
