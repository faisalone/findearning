<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // General settings
        $settings = [
            // Site identity settings
            ['key' => 'site_title', 'value' => 'Weiboo'],
            ['key' => 'site_description', 'value' => 'Your premier online shopping destination'],
            ['key' => 'site_logo', 'value' => 'assets/images/logo-findearning.svg'],
            ['key' => 'favicon', 'value' => 'assets/images/favicon.ico'],
            
            // Contact information
            ['key' => 'contact_email', 'value' => 'contact@findearning.com'],
            ['key' => 'contact_email_label', 'value' => 'Get Support'],
            ['key' => 'contact_phone', 'value' => '+1 234 567 8900'],
            ['key' => 'contact_address', 'value' => '123 Street Name, City, Country'],
            ['key' => 'telegram_username', 'value' => 'username'],
            ['key' => 'telegram_label', 'value' => 'Connect on Telegram'],
            
            // Social links
            ['key' => 'social_facebook', 'value' => 'https://facebook.com/weiboo'],
            ['key' => 'social_twitter', 'value' => 'https://twitter.com/weiboo'],
            ['key' => 'social_instagram', 'value' => 'https://instagram.com/weiboo'],
            ['key' => 'social_linkedin', 'value' => 'https://linkedin.com/company/weiboo'],
            
            // Footer settings
            ['key' => 'about_us_title', 'value' => 'About Us'],
            ['key' => 'about_us_text', 'value' => 'Elegant pink origami design three type of dimensional view and decoration co Great for adding a decorative touch to any room\'s decor.'],
            ['key' => 'get_in_touch_text', 'value' => 'Get In Touch'],
            ['key' => 'get_in_touch_url', 'value' => '/contact'],
            ['key' => 'information_title', 'value' => 'Information'],
            ['key' => 'my_account_title', 'value' => 'My Account'],
            ['key' => 'newsletter_title', 'value' => 'Get Newsletter'],
            ['key' => 'newsletter_text', 'value' => 'Don\'t miss any updates and offers!'],
            ['key' => 'newsletter_button_text', 'value' => 'Subscribe Now'],
            ['key' => 'newsletter_button_url', 'value' => '#subscribe'],
            ['key' => 'newsletter_placeholder', 'value' => 'Enter email address'],
            ['key' => 'footer_copyright', 'value' => 'All rights reserved by'],
            ['key' => 'company_name', 'value' => 'findearning.us'],
            ['key' => 'company_url', 'value' => 'http://findearning.us'],
            ['key' => 'footer_credits', 'value' => 'Design & developed by'],
            ['key' => 'developer_name', 'value' => 'oyelab.com'],
            ['key' => 'developer_url', 'value' => 'http://oyelab.com'],
            
            // SEO settings
            ['key' => 'meta_description', 'value' => 'Weiboo - Your premier online shopping destination'],
            ['key' => 'meta_keywords', 'value' => 'ecommerce, online shopping, products, store'],
            
            // Payment settings
            ['key' => 'currency', 'value' => 'USD'],
            ['key' => 'currency_symbol', 'value' => '$'],
            
            // Email settings
            ['key' => 'admin_email', 'value' => 'admin@weiboo.com'],
            ['key' => 'notification_email', 'value' => 'notifications@weiboo.com'],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => $setting['key']],
                ['value' => $setting['value']]
            );
        }
    }
}
