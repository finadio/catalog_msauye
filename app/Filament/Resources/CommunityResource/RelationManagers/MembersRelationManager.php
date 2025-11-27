<?php

namespace App\Filament\Resources\CommunityResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MembersRelationManager extends RelationManager
{
    protected static string $relationship = 'users'; // Using the 'users' relationship from Community model which is belongsToMany

    protected static ?string $recordTitleAttribute = 'name';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name') // This might be tricky with belongsToMany pivot
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nama User')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email'),
                Tables\Columns\TextColumn::make('pivot.role')
                    ->label('Role')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'admin' => 'danger',
                        'member' => 'info',
                    }),
                Tables\Columns\TextColumn::make('pivot.status')
                    ->label('Status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'approved' => 'success',
                        'pending' => 'warning',
                        'rejected' => 'danger',
                    }),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                // Tables\Actions\AttachAction::make(),
            ])
            ->actions([
                // Tables\Actions\DetachAction::make(),
                Tables\Actions\Action::make('promote_admin')
                    ->label('Jadikan Admin')
                    ->icon('heroicon-o-shield-check')
                    ->color('success')
                    ->visible(fn ($record) => $record->pivot->role !== 'admin')
                    ->action(function ($record) {
                        $this->getOwnerRecord()->members()->where('user_id', $record->id)->update(['role' => 'admin']);
                    }),
                Tables\Actions\Action::make('demote_member')
                    ->label('Jadikan Member')
                    ->icon('heroicon-o-user')
                    ->color('info')
                    ->visible(fn ($record) => $record->pivot->role === 'admin')
                    ->action(function ($record) {
                        $this->getOwnerRecord()->members()->where('user_id', $record->id)->update(['role' => 'member']);
                    }),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DetachBulkAction::make(),
                // ]),
            ]);
    }
}
