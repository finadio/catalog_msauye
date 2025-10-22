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
            // Gunakan Laravel auth, bukan Filament login
            ->authGuard('web')
            // Color scheme modern
            ->colors([
                'primary' => Color::Blue,
                'danger' => Color::Red,
                'gray' => Color::Slate,
                'info' => Color::Sky,
                'success' => Color::Green,
                'warning' => Color::Amber,
            ])
            // Dark mode support
            ->darkMode(false)
            // Font modern
            ->font('Inter')
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
                fn () => Blade::render('<style>
                    /* Subtle hover effects on stats cards */
                    .fi-wi-stats-overview-stat {
                        transition: all 0.2s ease-in-out;
                    }
                    .fi-wi-stats-overview-stat:hover {
                        transform: translateY(-2px);
                        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
                    }
                    /* Widget border radius */
                    .fi-section {
                        border-radius: 0.75rem;
                        transition: box-shadow 0.2s ease-in-out;
                    }
                    .fi-section:hover {
                        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
                    }
                    /* Sidebar spacing fix */
                    .fi-sidebar-nav {
                        gap: 0.25rem !important;
                    }
                    .fi-sidebar-item {
                        margin-bottom: 0 !important;
                    }
                    .fi-sidebar-group {
                        gap: 0.25rem !important;
                    }
                    .fi-sidebar-group-items {
                        gap: 0.25rem !important;
                    }
                    .fi-sidebar-group-label {
                        margin-top: 0.75rem !important;
                        margin-bottom: 0.5rem !important;
                    }
                </style>')
            );
    }
}
