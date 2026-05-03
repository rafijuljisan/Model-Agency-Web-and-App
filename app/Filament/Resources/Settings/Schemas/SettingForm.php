<?php

namespace App\Filament\Resources\Settings\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class SettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Global Settings')
                    ->columnSpanFull()
                    ->tabs([
                        // TAB 1: BRANDING
                        Tab::make('Branding')
                            ->icon('heroicon-o-paint-brush')
                            ->columns(2)
                            ->schema([
                                TextInput::make('site_name')->required(),
                                TextInput::make('license_number')
                                    ->label('Government License Number')
                                    ->placeholder('e.g. 03-090585'),
                                Textarea::make('site_description')->columnSpanFull(),
                                FileUpload::make('logo')
                                    ->image()
                                    ->disk('public')
                                    ->directory('settings'),
                                FileUpload::make('favicon')
                                    ->image()
                                    ->disk('public')
                                    ->directory('settings'),
                                FileUpload::make('photocard_frame')
                                    ->label('Membership Card Frame (PNG, 1200×1200px)')
                                    ->helperText('Upload your transparent-area frame. Artists\' photos will be placed inside the cutout.')
                                    ->image()
                                    ->disk('public')
                                    ->directory('settings/photocard')
                                    ->acceptedFileTypes(['image/png'])
                                    ->columnSpanFull(),
                            ]),

                        // TAB 2: CONTACT & SOCIALS
                        // TAB 2: CONTACT & SOCIALS
                        Tab::make('Contact & Location')
                            ->icon('heroicon-o-map-pin')
                            ->columns(2)
                            ->schema([
                                // Core Contact
                                TextInput::make('contact_email')->email(),
                                TextInput::make('contact_phone')->tel(),

                                // Physical Location
                                Textarea::make('contact_address')
                                    ->label('Office Address')
                                    ->rows(3)
                                    ->columnSpanFull(),
                                TextInput::make('business_hours')
                                    ->label('Business Hours')
                                    ->placeholder('e.g., Mon - Fri: 10:00 AM - 6:00 PM')
                                    ->columnSpanFull(),

                                // Map
                                Textarea::make('google_map_embed_url')
                                    ->label('Google Maps Embed URL (src only)')
                                    ->helperText('Go to Google Maps > Share > Embed a map > Copy ONLY the link inside the src="..." attribute.')
                                    ->rows(2)
                                    ->columnSpanFull(),

                                // Socials
                                TextInput::make('facebook_url')->url()->label('Facebook URL'),
                                TextInput::make('instagram_url')->url()->label('Instagram URL'),
                                TextInput::make('youtube_url')->url()->label('YouTube URL'),
                                TextInput::make('linkedin_url')->url()->label('LinkedIn URL'),
                            ]),
                        Tab::make('About Page')
                            ->icon('heroicon-o-identification')
                            ->columns(2)
                            ->schema([
                                Textarea::make('mission_text')
                                    ->label('Our Mission')
                                    ->rows(4)
                                    ->columnSpan(1),

                                Textarea::make('vision_text')
                                    ->label('Our Vision')
                                    ->rows(4)
                                    ->columnSpan(1),

                                RichEditor::make('about_text')
                                    ->label('About Dhaka Model Agency')
                                    ->columnSpanFull()
                                    ->toolbarButtons(['bold', 'italic', 'bulletList', 'orderedList', 'h3']),

                                FileUpload::make('about_image')
                                    ->label('About Page Featured Image')
                                    ->image()
                                    ->disk('public')
                                    ->directory('settings')
                                    ->columnSpanFull(),

                                RichEditor::make('what_we_offer')
                                    ->label('What We Offer')
                                    ->columnSpanFull()
                                    ->toolbarButtons(['bold', 'italic', 'bulletList', 'orderedList']),

                                RichEditor::make('our_experience')
                                    ->label('Our Experience')
                                    ->columnSpanFull()
                                    ->toolbarButtons(['bold', 'italic', 'bulletList', 'orderedList']),

                                RichEditor::make('models_advice')
                                    ->label('Models Advice')
                                    ->columnSpanFull()
                                    ->toolbarButtons(['bold', 'italic', 'bulletList', 'orderedList']),
                            ]),
                        // TAB 3: PAYMENT METHODS
                        Tab::make('Payment Gateways')
                            ->icon('heroicon-o-banknotes')
                            ->columns(2)
                            ->schema([
                                // bKash
                                TextInput::make('bkash_number')->label('bKash Number'),
                                Select::make('bkash_type')->label('bKash Account Type')->options([
                                    'Send Money' => 'Personal (Send Money)',
                                    'Payment' => 'Merchant (Payment)',
                                ]),

                                // Nagad
                                TextInput::make('nagad_number')->label('Nagad Number'),
                                Select::make('nagad_type')->label('Nagad Account Type')->options([
                                    'Send Money' => 'Personal (Send Money)',
                                    'Payment' => 'Merchant (Payment)',
                                ]),

                                // Rocket
                                TextInput::make('rocket_number')->label('Rocket Number'),
                                Select::make('rocket_type')->label('Rocket Account Type')->options([
                                    'Send Money' => 'Personal (Send Money)',
                                    'Payment' => 'Merchant (Payment)',
                                ]),
                            ]),
                        Tab::make('SEO & Analytics')
                            ->icon('heroicon-o-magnifying-glass')
                            ->columns(2)
                            ->schema([

                                // ── Basic SEO ──
                                TextInput::make('meta_title')
                                    ->label('Default Meta Title')
                                    ->placeholder('e.g. AgencyMarket — Verified Talent Directory Bangladesh')
                                    ->helperText('Recommended: 50–60 characters')
                                    ->maxLength(60)
                                    ->columnSpanFull(),

                                Textarea::make('meta_description')
                                    ->label('Default Meta Description')
                                    ->placeholder('A short description of your site for search engines...')
                                    ->helperText('Recommended: 150–160 characters')
                                    ->rows(3)
                                    ->maxLength(160)
                                    ->columnSpanFull(),

                                TextInput::make('meta_keywords')
                                    ->label('Meta Keywords')
                                    ->placeholder('model, actor, talent, bangladesh, dhaka')
                                    ->helperText('Comma-separated keywords (less important for modern SEO)')
                                    ->columnSpanFull(),

                                FileUpload::make('og_image')
                                    ->label('Default Social Share Image (OG Image)')
                                    ->helperText('Recommended size: 1200×630px. Used when sharing on Facebook, WhatsApp etc.')
                                    ->image()
                                    ->disk('public')
                                    ->directory('settings/seo')
                                    ->columnSpanFull(),

                                // ── Analytics & Tracking ──
                                TextInput::make('google_analytics_id')
                                    ->label('Google Analytics 4 ID')
                                    ->placeholder('G-XXXXXXXXXX')
                                    ->helperText('Find this in Google Analytics → Admin → Data Streams'),

                                TextInput::make('google_tag_manager_id')
                                    ->label('Google Tag Manager ID')
                                    ->placeholder('GTM-XXXXXXX'),

                                TextInput::make('google_search_console_id')
                                    ->label('Google Search Console Verification')
                                    ->placeholder('Paste the content="..." value from the meta tag')
                                    ->helperText('In Search Console → Settings → Ownership verification → HTML tag → copy only the content value'),

                                TextInput::make('facebook_pixel_id')
                                    ->label('Facebook Pixel ID')
                                    ->placeholder('e.g. 1234567890123456'),

                                TextInput::make('facebook_capi_token')
                                    ->label('Facebook CAPI Access Token')
                                    ->placeholder('Paste your System User Access Token here')
                                    ->password()
                                    ->revealable()
                                    ->helperText('Generate this in Facebook Events Manager > Settings > Conversions API > Generate access token.'),

                                TextInput::make('facebook_test_event_code')
                                    ->label('Test Event Code')
                                    ->placeholder('e.g. TEST54321')
                                    ->helperText('Use this for testing in the Events Manager. Clear this field when going live in production.'),

                                    // ── TikTok Pixel ──
                                TextInput::make('tiktok_pixel_id')
                                    ->label('TikTok Pixel ID')
                                    ->placeholder('e.g. CXXXXXXXXXXXXXXX')
                                    ->helperText('Found in TikTok Events Manager → your Pixel → Settings'),

                                TextInput::make('tiktok_access_token')
                                    ->label('TikTok Events API Access Token')
                                    ->placeholder('Paste your generated access token here')
                                    ->password()
                                    ->revealable()
                                    ->helperText('TikTok Events Manager → your Pixel → Settings → Generate Access Token'),

                                TextInput::make('tiktok_test_event_code')
                                    ->label('TikTok Test Event Code')
                                    ->placeholder('e.g. TEST12345')
                                    ->helperText('Use for testing only. Clear this when going live.'),
                                // ── Sitemap & Robots ──
                                Toggle::make('sitemap_enabled')
                                    ->label('Enable Sitemap (/sitemap.xml)')
                                    ->default(true)
                                    ->columnSpanFull(),

                                Textarea::make('robots_txt')
                                    ->label('robots.txt Content')
                                    ->helperText('Controls which pages search engines can crawl. Leave blank for default.')
                                    ->rows(6)
                                    ->placeholder("User-agent: *\nAllow: /\nDisallow: /admin/\nSitemap: https://yourdomain.com/sitemap.xml")
                                    ->columnSpanFull(),

                                // ── Schema.org ──
                                Select::make('schema_org_type')
                                    ->label('Business Schema Type')
                                    ->options([
                                        'Organization' => 'Organization',
                                        'LocalBusiness' => 'Local Business',
                                        'EntertainmentBusiness' => 'Entertainment Business',
                                        'EmploymentAgency' => 'Employment / Talent Agency',
                                    ])
                                    ->default('Organization')
                                    ->helperText('Used for structured data — helps Google understand your business type'),
                            ]),
                    ]),
            ]);
    }
}
