<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NotificationResource\Pages;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Notifications\DatabaseNotification;
use Filament\Support\Colors\Color;

class NotificationResource extends Resource
{
    protected static ?string $model = DatabaseNotification::class;

    protected static ?string $navigationIcon = 'heroicon-o-bell';
    
    protected static ?string $navigationLabel = 'Notifikasi';
    
    protected static ?string $modelLabel = 'Notifikasi';
    
    protected static ?string $pluralModelLabel = 'Notifikasi';
    
    protected static ?string $navigationGroup = 'Sistem';
    
    protected static ?int $navigationSort = 1;

    // Badge untuk unread notifications
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::query()
            ->whereNull('read_at')
            ->where('notifiable_id', auth()->id())
            ->count() ?: null;
    }
    
    public static function getNavigationBadgeColor(): string|array|null
    {
        $count = static::getModel()::query()
            ->whereNull('read_at')
            ->where('notifiable_id', auth()->id())
            ->count();
            
        return $count > 0 ? 'danger' : 'gray';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Detail Notifikasi')
                    ->schema([
                        Forms\Components\TextInput::make('type')
                            ->label('Tipe')
                            ->disabled(),
                        Forms\Components\Textarea::make('data')
                            ->label('Data')
                            ->formatStateUsing(fn ($state) => json_encode($state, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE))
                            ->rows(10)
                            ->disabled(),
                        Forms\Components\DateTimePicker::make('created_at')
                            ->label('Dibuat Pada')
                            ->disabled(),
                        Forms\Components\DateTimePicker::make('read_at')
                            ->label('Dibaca Pada')
                            ->disabled(),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->modifyQueryUsing(fn (Builder $query) => $query->where('notifiable_id', auth()->id()))
            ->columns([
                Tables\Columns\IconColumn::make('read_at')
                    ->label('Status')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-bell-alert')
                    ->trueColor('success')
                    ->falseColor('warning')
                    ->getStateUsing(fn ($record) => !is_null($record->read_at))
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('data.title')
                    ->label('Judul')
                    ->searchable()
                    ->weight('bold')
                    ->color(fn ($record) => is_null($record->read_at) ? 'primary' : 'gray'),
                    
                Tables\Columns\TextColumn::make('data.message')
                    ->label('Pesan')
                    ->searchable()
                    ->limit(50)
                    ->wrap(),
                    
                Tables\Columns\BadgeColumn::make('type')
                    ->label('Tipe')
                    ->formatStateUsing(fn ($state) => class_basename($state))
                    ->colors([
                        'success' => fn ($state) => str_contains($state, 'Approved'),
                        'danger' => fn ($state) => str_contains($state, 'Rejected'),
                        'warning' => fn ($state) => str_contains($state, 'Submitted'),
                        'info' => fn ($state) => str_contains($state, 'Registered'),
                    ]),
                    
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Waktu')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->since(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'unread' => 'Belum Dibaca',
                        'read' => 'Sudah Dibaca',
                    ])
                    ->query(function (Builder $query, array $data) {
                        if ($data['value'] === 'unread') {
                            return $query->whereNull('read_at');
                        }
                        if ($data['value'] === 'read') {
                            return $query->whereNotNull('read_at');
                        }
                        return $query;
                    }),
                    
                Tables\Filters\SelectFilter::make('type')
                    ->label('Tipe Notifikasi')
                    ->options([
                        'NewProductSubmittedNotification' => 'Produk Baru',
                        'ProductStatusChangedNotification' => 'Status Produk',
                        'NewUserRegisteredNotification' => 'User Baru',
                    ])
                    ->query(function (Builder $query, array $data) {
                        if (!empty($data['value'])) {
                            return $query->where('type', 'LIKE', '%' . $data['value'] . '%');
                        }
                        return $query;
                    }),
            ])
            ->actions([
                Tables\Actions\Action::make('mark_read')
                    ->label('Tandai Dibaca')
                    ->icon('heroicon-o-check')
                    ->color('success')
                    ->hidden(fn ($record) => !is_null($record->read_at))
                    ->action(function ($record) {
                        $record->markAsRead();
                    })
                    ->successNotificationTitle('Notifikasi ditandai sudah dibaca'),
                    
                Tables\Actions\ViewAction::make()
                    ->label('Lihat')
                    ->modalHeading('Detail Notifikasi')
                    ->before(function ($record) {
                        if (is_null($record->read_at)) {
                            $record->markAsRead();
                        }
                    }),
                    
                Tables\Actions\DeleteAction::make()
                    ->label('Hapus'),
            ])
            ->bulkActions([
                Tables\Actions\BulkAction::make('mark_all_read')
                    ->label('Tandai Semua Dibaca')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->action(function ($records) {
                        $records->each->markAsRead();
                    })
                    ->deselectRecordsAfterCompletion()
                    ->successNotificationTitle('Semua notifikasi ditandai sudah dibaca'),
                    
                Tables\Actions\DeleteBulkAction::make()
                    ->label('Hapus'),
            ])
            ->emptyStateHeading('Tidak ada notifikasi')
            ->emptyStateDescription('Anda belum memiliki notifikasi')
            ->emptyStateIcon('heroicon-o-bell-slash');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListNotifications::route('/'),
        ];
    }
    
    // Disable create & edit
    public static function canCreate(): bool
    {
        return false;
    }
}
