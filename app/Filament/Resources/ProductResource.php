<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductStatus;
use App\Models\Umkm;
use App\Notifications\ProductStatusChangedNotification;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Storage;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';
    
    protected static ?string $navigationLabel = 'Produk';
    
    protected static ?string $modelLabel = 'Produk';
    
    protected static ?string $pluralModelLabel = 'Produk';
    
    protected static ?string $navigationGroup = 'Manajemen Katalog';
    
    protected static ?int $navigationSort = 2;
    
    // Badge untuk pending products
    public static function getNavigationBadge(): ?string
    {
        $pendingStatus = ProductStatus::where('name', 'pending')->first();
        if (!$pendingStatus) {
            return null;
        }
        
        $count = static::getModel()::where('status_id', $pendingStatus->id)->count();
        return $count > 0 ? (string) $count : null;
    }
    
    public static function getNavigationBadgeColor(): string|array|null
    {
        return 'warning';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('umkm_id')
                    ->label('UMKM')
                    ->relationship('umkm', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                    
                Forms\Components\TextInput::make('name')
                    ->label('Nama Produk')
                    ->required()
                    ->maxLength(255),
                    
                Forms\Components\Textarea::make('description')
                    ->label('Deskripsi')
                    ->required()
                    ->rows(4)
                    ->columnSpanFull(),
                    
                Forms\Components\TextInput::make('price')
                    ->label('Harga')
                    ->numeric()
                    ->prefix('Rp')
                    ->required(),
                    
                Forms\Components\Toggle::make('show_price')
                    ->label('Tampilkan Harga')
                    ->default(true),
                    
                Forms\Components\Select::make('category_id')
                    ->label('Kategori')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                    
                Forms\Components\TextInput::make('location')
                    ->label('Lokasi')
                    ->maxLength(255),
                    
                Forms\Components\FileUpload::make('photo')
                    ->label('Foto Produk')
                    ->image()
                    ->disk('public')
                    ->directory('produk')
                    ->maxSize(2048)
                    ->imageEditor()
                    ->required(),
                    
                Forms\Components\TextInput::make('whatsapp')
                    ->label('WhatsApp')
                    ->tel()
                    ->maxLength(255),
                    
                Forms\Components\TextInput::make('instagram')
                    ->label('Instagram')
                    ->maxLength(255),
                    
                Forms\Components\TextInput::make('tiktok_shop')
                    ->label('TikTok Shop')
                    ->maxLength(255),
                    
                Forms\Components\TextInput::make('website')
                    ->label('Website')
                    ->url()
                    ->maxLength(255),
                    
                Forms\Components\TextInput::make('telepon')
                    ->label('Telepon')
                    ->tel()
                    ->maxLength(255),
                    
                Forms\Components\Select::make('status_id')
                    ->label('Status')
                    ->relationship('status', 'name')
                    ->default(function() {
                        return ProductStatus::where('name', 'pending')->first()?->id;
                    })
                    ->required()
                    ->disabled(fn ($record) => $record === null), // Only editable on create
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('photo')
                    ->label('Foto')
                    ->size(60)
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
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('umkm.name')
                    ->label('UMKM')
                    ->searchable()
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('category.name')
                    ->label('Kategori')
                    ->sortable()
                    ->badge(),
                    
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
                    ->label('Dibuat')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category_id')
                    ->label('Kategori')
                    ->relationship('category', 'name'),
                    
                Tables\Filters\SelectFilter::make('status_id')
                    ->label('Status')
                    ->relationship('status', 'name'),
                    
                Tables\Filters\SelectFilter::make('umkm_id')
                    ->label('UMKM')
                    ->relationship('umkm', 'name')
                    ->searchable()
                    ->preload(),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    
                    Tables\Actions\Action::make('approve')
                        ->label('Setujui')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->visible(fn (Product $record) => !in_array($record->status->name, ['aktif', 'approved']))
                        ->requiresConfirmation()
                        ->action(function (Product $record) {
                            $status = ProductStatus::where('name', 'approved')->first() ?? ProductStatus::where('name', 'aktif')->first();
                            if ($status) {
                                $record->update(['status_id' => $status->id]);
                                
                                // Kirim notifikasi ke user UMKM
                                if ($record->umkm && $record->umkm->user) {
                                    $record->umkm->user->notify(new ProductStatusChangedNotification($record, 'approved'));
                                }
                                
                                Notification::make()
                                    ->success()
                                    ->title('Produk Disetujui')
                                    ->body("Produk \"{$record->name}\" berhasil disetujui.")
                                    ->send();
                            }
                        }),
                        
                    Tables\Actions\Action::make('reject')
                        ->label('Tolak')
                        ->icon('heroicon-o-x-circle')
                        ->color('danger')
                        ->visible(fn (Product $record) => !in_array($record->status->name, ['ditolak', 'rejected']))
                        ->requiresConfirmation()
                        ->action(function (Product $record) {
                            $status = ProductStatus::where('name', 'rejected')->first() ?? ProductStatus::where('name', 'ditolak')->first();
                            if ($status) {
                                $record->update(['status_id' => $status->id]);
                                
                                // Kirim notifikasi ke user UMKM
                                if ($record->umkm && $record->umkm->user) {
                                    $record->umkm->user->notify(new ProductStatusChangedNotification($record, 'ditolak'));
                                }
                                
                                Notification::make()
                                    ->danger()
                                    ->title('Produk Ditolak')
                                    ->body("Produk \"{$record->name}\" telah ditolak.")
                                    ->send();
                            }
                        }),
                        
                    Tables\Actions\DeleteAction::make()
                        ->before(function (Product $record) {
                            // Hapus foto dari storage
                            if ($record->photo) {
                                Storage::disk('public')->delete($record->photo);
                            }
                        }),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->before(function ($records) {
                            // Hapus foto dari storage untuk semua record
                            foreach ($records as $record) {
                                if ($record->photo) {
                                    Storage::disk('public')->delete($record->photo);
                                }
                            }
                        }),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'view' => Pages\ViewProduct::route('/{record}'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
