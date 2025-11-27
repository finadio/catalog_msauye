<?php

namespace App\Filament\Widgets;

use App\Models\Product;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestProducts extends BaseWidget
{
    protected static ?int $sort = 3;

    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->heading('Produk Terbaru')
            ->description('5 produk yang baru ditambahkan')
            ->query(
                Product::query()
                    ->with(['umkm', 'category', 'status'])
                    ->latest()
                    ->limit(5)
            )
            ->columns([
                Tables\Columns\ImageColumn::make('photo')
                    ->label('Foto')
                    ->circular()
                    ->checkFileExistence(false)
                    ->defaultImageUrl(asset('img/produk-dummy1.jpg'))
                    ->state(function ($record) {
                        if (!$record->photo) return null;
                        if (str_starts_with($record->photo, 'http')) {
                            return $record->photo;
                        }
                        if (str_starts_with($record->photo, 'produk-dummy')) {
                            return asset('img/' . $record->photo);
                        }
                        return asset('storage/' . $record->photo);
                    }),

                Tables\Columns\TextColumn::make('name')
                    ->label('Nama Produk')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('category.name')
                    ->label('Kategori')
                    ->badge()
                    ->color('info'),

                Tables\Columns\TextColumn::make('umkm.name')
                    ->label('UMKM')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('price')
                    ->label('Harga')
                    ->money('IDR')
                    ->sortable(),

                Tables\Columns\TextColumn::make('status.name')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'approved', 'aktif' => 'success',
                        'rejected', 'ditolak' => 'danger',
                        default => 'gray',
                    }),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Ditambahkan')
                    ->dateTime('d M Y, H:i')
                    ->sortable()
                    ->since(),
            ])
            ->actions([
                Tables\Actions\Action::make('view')
                    ->label('Lihat')
                    ->icon('heroicon-o-eye')
                    ->url(fn(Product $record): string => route('filament.admin.resources.products.view', ['record' => $record])),
            ]);
    }
}
