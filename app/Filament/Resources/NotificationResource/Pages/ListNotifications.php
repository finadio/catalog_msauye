<?php

namespace App\Filament\Resources\NotificationResource\Pages;

use App\Filament\Resources\NotificationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListNotifications extends ListRecords
{
    protected static string $resource = NotificationResource::class;
    
    protected static ?string $title = 'Notifikasi';

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('mark_all_read')
                ->label('Tandai Semua Dibaca')
                ->icon('heroicon-o-check-circle')
                ->color('success')
                ->action(function () {
                    auth()->user()->unreadNotifications->markAsRead();
                })
                ->visible(fn () => auth()->user()->unreadNotifications->count() > 0)
                ->successNotificationTitle('Semua notifikasi ditandai sudah dibaca'),
        ];
    }
}
