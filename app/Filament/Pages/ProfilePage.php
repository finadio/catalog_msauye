<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfilePage extends Page implements HasForms
{
    use InteractsWithForms;
    
    protected static ?string $navigationIcon = 'heroicon-o-user-circle';
    
    protected static ?string $navigationLabel = 'Edit Profile';
    
    protected static ?string $title = 'Edit Profile';
    
    protected static ?string $navigationGroup = 'Sistem';
    
    protected static ?int $navigationSort = 2;

    protected static string $view = 'filament.pages.profile-page';
    
    public ?array $profileData = [];
    public ?array $passwordData = [];
    
    public function mount(): void
    {
        $this->fillForms();
    }
    
    protected function fillForms(): void
    {
        $this->profileData = [
            'name' => auth()->user()->name,
            'email' => auth()->user()->email,
        ];
    }
    
    public function getProfileFormSchema(): array
    {
        return [
            Forms\Components\Section::make('Informasi Profile')
                ->schema([
                    Forms\Components\TextInput::make('name')
                        ->label('Nama')
                        ->required()
                        ->maxLength(255),
                    Forms\Components\TextInput::make('email')
                        ->label('Email')
                        ->email()
                        ->required()
                        ->maxLength(255),
                ])
        ];
    }
    
    public function getPasswordFormSchema(): array
    {
        return [
            Forms\Components\Section::make('Update Password')
                ->schema([
                    Forms\Components\TextInput::make('current_password')
                        ->label('Password Saat Ini')
                        ->password()
                        ->required()
                        ->rule('current_password'),
                    Forms\Components\TextInput::make('password')
                        ->label('Password Baru')
                        ->password()
                        ->required()
                        ->rule(Password::default())
                        ->same('password_confirmation'),
                    Forms\Components\TextInput::make('password_confirmation')
                        ->label('Konfirmasi Password Baru')
                        ->password()
                        ->required(),
                ])
        ];
    }
    
    public function updateProfile(): void
    {
        $data = $this->form->getState()['profileData'];
        
        $user = auth()->user();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->save();
        
        Notification::make()
            ->title('Profile berhasil diupdate')
            ->success()
            ->send();
            
        $this->fillForms();
    }
    
    public function updatePassword(): void
    {
        $data = $this->form->getState()['passwordData'];
        
        // Verify current password
        if (!Hash::check($data['current_password'], auth()->user()->password)) {
            Notification::make()
                ->title('Password saat ini tidak benar')
                ->danger()
                ->send();
            return;
        }
        
        $user = auth()->user();
        $user->password = Hash::make($data['password']);
        $user->save();
        
        Notification::make()
            ->title('Password berhasil diupdate')
            ->success()
            ->send();
            
        $this->passwordData = [];
    }
    
    protected function getForms(): array
    {
        return [
            'profileForm' => $this->makeForm()
                ->schema($this->getProfileFormSchema())
                ->statePath('profileData')
                ->model(auth()->user()),
            'passwordForm' => $this->makeForm()
                ->schema($this->getPasswordFormSchema())
                ->statePath('passwordData'),
        ];
    }
}
