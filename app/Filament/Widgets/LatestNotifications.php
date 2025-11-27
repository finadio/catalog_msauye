<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Notifications\DatabaseNotification;

class LatestNotifications extends BaseWidget
{
    protected static ?int $sort = 4;
    
    protected int | string | array $columnSpan = 'full';
    
    protected static ?string $heading = 'Notifikasi Terbaru';
    
    public function table(Table $table): Table
    {
        return $table
            ->query(
                DatabaseNotification::query()
                    ->where('notifiable_id', auth()->id())
                    ->latest()
                    ->limit(5)
            )
            ->columns([
                Tables\Columns\IconColumn::make('read_at')
                    ->label('')
                    ->icon(fn ($record) => is_null($record->read_at) ? 'heroicon-s-bell-alert' : 'heroicon-o-check-circle')
                    ->color(fn ($record) => is_null($record->read_at) ? 'warning' : 'success')
                    ->tooltip(fn ($record) => is_null($record->read_at) ? 'Belum dibaca' : 'Sudah dibaca'),
                    
                Tables\Columns\TextColumn::make('data.title')
                    ->label('Judul')
                    ->weight('bold')
                    ->description(fn ($record) => $record->data['message'] ?? '')
                    ->wrap(),
                    
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Waktu')
                    ->since()
                    ->color('gray')
                    ->alignEnd(),
            ])
            ->actions([
                Tables\Actions\Action::make('mark_as_read')
                    ->label('Tandai Dibaca')
                    ->icon('heroicon-o-check')
                    ->color('success')
                    ->visible(fn ($record) => is_null($record->read_at))
                    ->action(fn ($record) => $record->markAsRead()),
                    
                Tables\Actions\Action::make('view')
                    ->label('Lihat')
                    ->icon('heroicon-o-eye')
                    ->color('primary')
                    ->url(fn ($record) => route('filament.admin.resources.notifications.index')),
            ])
            ->paginated(false);
    }
}
