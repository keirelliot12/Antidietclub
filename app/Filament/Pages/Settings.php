<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Support\Exceptions\Halt;
use Illuminate\Support\Facades\Log;

class Settings extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationLabel = 'Settings';
    protected static ?int $navigationSort = 100;
    protected static ?string $title = 'Site Settings';

    protected static string $view = 'filament.pages.settings';

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill([
            'site_name' => Setting::get('site_name', ''),
            'site_description' => Setting::get('site_description', ''),
            'contact_email' => Setting::get('contact_email', ''),

            'instagram_url' => Setting::get('instagram_url', ''),
            'tiktok_url' => Setting::get('tiktok_url', ''),
            'facebook_url' => Setting::get('facebook_url', ''),

            'whatsapp_phone' => Setting::get('whatsapp_phone', ''),
            'whatsapp_welcome_message' => Setting::get('whatsapp_welcome_message', ''),

            'meta_title' => Setting::get('meta_title', ''),
            'meta_description' => Setting::get('meta_description', ''),
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('General')
                    ->description('Basic site information')
                    ->icon('heroicon-o-globe-alt')
                    ->schema([
                        Forms\Components\TextInput::make('site_name')
                            ->label('Site Name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('site_description')
                            ->label('Description')
                            ->required()
                            ->rows(3)
                            ->maxLength(65535),
                        Forms\Components\TextInput::make('contact_email')
                            ->label('Contact Email')
                            ->email()
                            ->required()
                            ->maxLength(255),
                    ])
                    ->columns(1),

                Forms\Components\Section::make('Social Media')
                    ->description('Your social media links')
                    ->icon('heroicon-o-share')
                    ->schema([
                        Forms\Components\TextInput::make('instagram_url')
                            ->label('Instagram URL')
                            ->url()
                            ->prefix('https://')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('tiktok_url')
                            ->label('TikTok URL')
                            ->url()
                            ->prefix('https://')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('facebook_url')
                            ->label('Facebook URL')
                            ->url()
                            ->prefix('https://')
                            ->maxLength(255),
                    ])
                    ->columns(1),

                Forms\Components\Section::make('WhatsApp')
                    ->description('WhatsApp integration settings')
                    ->icon('heroicon-o-chat-bubble-left-right')
                    ->schema([
                        Forms\Components\TextInput::make('whatsapp_phone')
                            ->label('Phone Number')
                            ->required()
                            ->tel()
                            ->placeholder('e.g., 628123456789')
                            ->maxLength(20),
                        Forms\Components\Textarea::make('whatsapp_welcome_message')
                            ->label('Welcome Message')
                            ->required()
                            ->rows(3)
                            ->placeholder('Message shown to users when they start a chat')
                            ->maxLength(65535),
                    ])
                    ->columns(1),

                Forms\Components\Section::make('SEO')
                    ->description('Search engine optimization settings')
                    ->icon('heroicon-o-magnifying-glass')
                    ->schema([
                        Forms\Components\TextInput::make('meta_title')
                            ->label('Meta Title')
                            ->required()
                            ->maxLength(255)
                            ->helperText('The title tag for SEO (recommended: 50-60 characters)'),
                        Forms\Components\Textarea::make('meta_description')
                            ->label('Meta Description')
                            ->required()
                            ->rows(3)
                            ->maxLength(65535)
                            ->helperText('The meta description for SEO (recommended: 150-160 characters)'),
                    ])
                    ->columns(1),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        try {
            $data = $this->form->getState();

            // General Settings
            Setting::set('site_name', $data['site_name'], 'text', 'general');
            Setting::set('site_description', $data['site_description'], 'textarea', 'general');
            Setting::set('contact_email', $data['contact_email'], 'email', 'general');

            // Social Media Settings
            Setting::set('instagram_url', $data['instagram_url'], 'url', 'social');
            Setting::set('tiktok_url', $data['tiktok_url'], 'url', 'social');
            Setting::set('facebook_url', $data['facebook_url'], 'url', 'social');

            // WhatsApp Settings
            Setting::set('whatsapp_phone', $data['whatsapp_phone'], 'tel', 'whatsapp');
            Setting::set('whatsapp_welcome_message', $data['whatsapp_welcome_message'], 'textarea', 'whatsapp');

            // SEO Settings
            Setting::set('meta_title', $data['meta_title'], 'text', 'seo');
            Setting::set('meta_description', $data['meta_description'], 'textarea', 'seo');

            $this->getSavedNotification()->send();
        } catch (Halt $exception) {
            return;
        }
    }

    protected function getSavedNotification(): \Filament\Notifications\Notification
    {
        return \Filament\Notifications\Notification::make()
            ->success()
            ->title('Settings Saved')
            ->body('Your settings have been updated successfully.');
    }
}