<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\View\PanelsRenderHook;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Illuminate\Support\Facades\Blade;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('filament')
            // Branding
            ->brandName('UMKMSmart')
            ->brandLogo(fn () => view('filament.components.brand-logo'))
            ->favicon(asset('img/shaka_utama.png'))
            // Auth configuration - gunakan Laravel login
            ->authGuard('web')
            // Color scheme modern
            ->colors([
                'primary' => Color::Indigo,
                'danger' => Color::Rose,
                'gray' => Color::Slate,
                'info' => Color::Cyan,
                'success' => Color::Emerald,
                'warning' => Color::Orange,
            ])
            // Dark mode support
            ->darkMode(true)
            // Font modern
            ->font('Poppins')
            // Sidebar
            ->sidebarCollapsibleOnDesktop()
            ->sidebarWidth('16rem')
            // Navigation
            ->navigationGroups([
                'Manajemen Katalog',
                'Konten',
                'User Management',
                'Sistem',
            ])
            // Resources & Pages
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                \App\Filament\Widgets\StatsOverview::class,
                \App\Filament\Widgets\ProductsChart::class,
                \App\Filament\Widgets\LatestProducts::class,
                \App\Filament\Widgets\LatestNotifications::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            // Database Notifications
            ->databaseNotifications()
            ->databaseNotificationsPolling('30s')
            // Global search
            ->globalSearchKeyBindings(['command+k', 'ctrl+k'])
            ->globalSearchFieldKeyBindingSuffix()
            // Topbar
            ->topNavigation(false)
            // Breadcrumbs
            ->breadcrumbs(true)
            // Max content width
            ->maxContentWidth('full')
            // Custom CSS for hover effects
            ->renderHook(
                PanelsRenderHook::HEAD_END,
                fn () => Blade::render('
                <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
                <style>
                    /* General Font Smoothing */
                    body {
                        -webkit-font-smoothing: antialiased;
                        -moz-osx-font-smoothing: grayscale;
                        background-color: #f8fafc; /* Slate 50 */
                        font-family: "Poppins", sans-serif;
                    }
                    
                    /* Dark mode background override */
                    .dark body {
                        background-color: #0f172a; /* Slate 900 */
                    }

                    /* Sidebar Active Item Style */
                    .fi-sidebar-item-active a {
                        background-color: rgba(var(--primary-500), 0.1) !important;
                        color: rgb(var(--primary-600)) !important;
                        font-weight: 600;
                    }
                    .fi-sidebar-item-active a:hover {
                        background-color: rgba(var(--primary-500), 0.15) !important;
                    }

                    /* Subtle hover effects on stats cards */
                    .fi-wi-stats-overview-stat {
                        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                        border: 1px solid rgba(226, 232, 240, 0.8);
                        background: white;
                    }
                    .dark .fi-wi-stats-overview-stat {
                        background: #1e293b;
                        border-color: #334155;
                    }
                    
                    .fi-wi-stats-overview-stat:hover {
                        transform: translateY(-4px);
                        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
                        border-color: rgb(var(--primary-500));
                    }

                    /* Widget border radius & shadow */
                    .fi-section, .fi-wi-widget {
                        border-radius: 1rem;
                        box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
                        transition: box-shadow 0.3s ease;
                        border: 1px solid rgba(226, 232, 240, 0.8);
                    }
                    .dark .fi-section, .dark .fi-wi-widget {
                        border-color: #334155;
                    }
                    
                    .fi-section:hover, .fi-wi-widget:hover {
                        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
                    }

                    /* Sidebar styling */
                    .fi-sidebar-nav {
                        gap: 0.5rem !important;
                    }
                    .fi-sidebar-item {
                        transition: transform 0.2s ease;
                    }
                    .fi-sidebar-item:hover {
                        transform: translateX(4px);
                    }
                    .fi-sidebar-group-label {
                        font-weight: 700;
                        letter-spacing: 0.05em;
                        text-transform: uppercase;
                        font-size: 0.7rem;
                        color: rgb(var(--gray-400));
                    }

                    /* Table styling */
                    .fi-ta-row {
                        transition: background-color 0.2s ease;
                    }
                    .fi-ta-row:hover {
                        background-color: rgba(var(--gray-50), 0.8);
                    }
                    .dark .fi-ta-row:hover {
                        background-color: rgba(255, 255, 255, 0.05);
                    }
                    
                    /* Button gradients */
                    .fi-btn-primary {
                        background-image: linear-gradient(to bottom right, rgb(var(--primary-500)), rgb(var(--primary-600)));
                        box-shadow: 0 4px 6px -1px rgba(var(--primary-500), 0.3), 0 2px 4px -1px rgba(var(--primary-500), 0.15);
                        transition: all 0.2s;
                    }
                    .fi-btn-primary:hover {
                        background-image: linear-gradient(to bottom right, rgb(var(--primary-400)), rgb(var(--primary-500)));
                        transform: scale(1.02);
                    }
                    
                    /* Topbar Glass Effect */
                    .fi-topbar {
                        background-color: rgba(255, 255, 255, 0.8);
                        backdrop-filter: blur(12px);
                    }
                    .dark .fi-topbar {
                        background-color: rgba(15, 23, 42, 0.8);
                    }
                </style>')
            );
    }
}
