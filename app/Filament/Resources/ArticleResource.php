<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArticleResource\Pages;
use App\Filament\Resources\ArticleResource\RelationManagers;
use App\Models\Article;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';
    
    protected static ?string $navigationLabel = 'Artikel';
    
    protected static ?string $modelLabel = 'Artikel';
    
    protected static ?string $pluralModelLabel = 'Artikel';
    
    protected static ?string $navigationGroup = 'Konten';
    
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Artikel')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Judul')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),
                            
                        Forms\Components\TextInput::make('slug')
                            ->label('Slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true)
                            ->readOnly(),
                            
                        Forms\Components\Select::make('type')
                            ->label('Tipe Artikel')
                            ->options([
                                'berita' => 'Berita',
                                'tutorial' => 'Tutorial',
                                'tips' => 'Tips',
                                'info' => 'Info',
                                'pengumuman' => 'Pengumuman',
                            ])
                            ->required()
                            ->searchable()
                            ->native(false),
                    ])->columns(2),
                    
                Forms\Components\Section::make('Konten')
                    ->schema([
                        Forms\Components\RichEditor::make('content')
                            ->label('Konten Artikel')
                            ->required()
                            ->fileAttachmentsDisk('public')
                            ->fileAttachmentsDirectory('article_attachments')
                            ->columnSpanFull(),
                    ]),
                    
                Forms\Components\Section::make('Gambar')
                    ->schema([
                        Forms\Components\FileUpload::make('photo')
                            ->label('Gambar Artikel')
                            ->image()
                            ->disk('public')
                            ->directory('article_images')
                            ->maxSize(2048)
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '16:9',
                                '4:3',
                                '1:1',
                            ]),
                    ]),
                    
                Forms\Components\Section::make('Metadata')
                    ->schema([
                        Forms\Components\DateTimePicker::make('published_at')
                            ->label('Tanggal Publikasi')
                            ->default(now())
                            ->required(),
                    ])
                    ->collapsible(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('photo')
                    ->label('Gambar')
                    ->size(60)
                    ->square()
                    ->checkFileExistence(false)
                    ->defaultImageUrl(asset('img/artikel-default.jpg'))
                    ->state(function ($record) {
                        if (!$record->photo) return null;
                        if (str_starts_with($record->photo, 'http')) {
                            return $record->photo;
                        }
                        if (str_starts_with($record->photo, 'artikel-')) {
                            return asset('img/' . $record->photo);
                        }
                        return asset('storage/' . $record->photo);
                    }),
                    
                Tables\Columns\TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->limit(50),
                    
                Tables\Columns\TextColumn::make('type')
                    ->label('Tipe')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'berita' => 'info',
                        'tutorial' => 'success',
                        'tips' => 'warning',
                        'info' => 'gray',
                        'pengumuman' => 'danger',
                        default => 'gray',
                    })
                    ->searchable()
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('published_at')
                    ->label('Tanggal Publikasi')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(),
                    
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('type')
                    ->label('Tipe Artikel')
                    ->options([
                        'berita' => 'Berita',
                        'tutorial' => 'Tutorial',
                        'tips' => 'Tips',
                        'info' => 'Info',
                        'pengumuman' => 'Pengumuman',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->before(function (Article $record) {
                        if ($record->photo) {
                            Storage::disk('public')->delete($record->photo);
                        }
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->before(function ($records) {
                            foreach ($records as $record) {
                                if ($record->photo) {
                                    Storage::disk('public')->delete($record->photo);
                                }
                            }
                        }),
                ]),
            ])
            ->defaultSort('published_at', 'desc');
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
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'view' => Pages\ViewArticle::route('/{record}'),
            'edit' => Pages\EditArticle::route('/{record}/edit'),
        ];
    }
}
