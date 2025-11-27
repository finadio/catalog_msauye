<?php

namespace App\Filament\Widgets;

use App\Models\Product;
use App\Models\Category;
use Filament\Widgets\ChartWidget;

class ProductsChart extends ChartWidget
{
    protected static ?string $heading = 'Produk per Kategori';
    
    protected static ?int $sort = 2;
    
    protected int | string | array $columnSpan = 'full';
    
    protected static ?string $maxHeight = '300px';

    protected function getData(): array
    {
        $categories = Category::withCount('products')->get();
        
        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Produk',
                    'data' => $categories->pluck('products_count')->toArray(),
                    'backgroundColor' => [
                        'rgba(99, 102, 241, 0.5)',  // indigo-500
                        'rgba(16, 185, 129, 0.5)',  // emerald-500
                        'rgba(249, 115, 22, 0.5)',  // orange-500
                        'rgba(244, 63, 94, 0.5)',   // rose-500
                        'rgba(6, 182, 212, 0.5)',   // cyan-500
                        'rgba(139, 92, 246, 0.5)',  // violet-500
                    ],
                    'borderColor' => [
                        'rgb(99, 102, 241)',
                        'rgb(16, 185, 129)',
                        'rgb(249, 115, 22)',
                        'rgb(244, 63, 94)',
                        'rgb(6, 182, 212)',
                        'rgb(139, 92, 246)',
                    ],
                    'borderWidth' => 2,
                ],
            ],
            'labels' => $categories->pluck('name')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
    
    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'display' => false,
                ],
            ],
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'ticks' => [
                        'stepSize' => 1,
                    ],
                ],
            ],
        ];
    }
}
