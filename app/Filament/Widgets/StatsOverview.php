<?php

namespace App\Filament\Widgets;

use App\Models\Umkm;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Article;
use App\Models\ProductStatus;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $pendingStatus = ProductStatus::where('name', 'pending')->first();
        
        return [
            Stat::make('Total UMKM', Umkm::count())
                ->description('Jumlah UMKM terdaftar')
                ->descriptionIcon('heroicon-m-building-storefront')
                ->color('success')
                ->chart([7, 12, 15, 18, 22, 24, 28]),
                
            Stat::make('Total Produk', Product::count())
                ->description('Semua produk dalam katalog')
                ->descriptionIcon('heroicon-m-shopping-bag')
                ->color('info')
                ->chart([15, 20, 25, 30, 35, 38, 42]),
                
            Stat::make('Produk Pending', Product::where('status_id', $pendingStatus?->id)->count())
                ->description('Menunggu persetujuan')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning')
                ->url(route('filament.admin.resources.products.index', [
                    'tableFilters[status_id][value]' => $pendingStatus?->id
                ])),
                
            Stat::make('User Pending', User::where('status', 'pending')->where('role', 'umkm')->count())
                ->description('User UMKM belum disetujui')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('warning')
                ->url(route('filament.admin.resources.umkms.index', [
                    'tableFilters[user.status][value]' => 'pending'
                ])),
                
            Stat::make('Kategori', Category::count())
                ->description('Kategori produk')
                ->descriptionIcon('heroicon-m-tag')
                ->color('gray'),
                
            Stat::make('Artikel', Article::count())
                ->description('Total artikel published')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('gray'),
        ];
    }
}
