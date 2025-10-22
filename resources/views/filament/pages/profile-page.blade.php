<x-filament-panels::page>
    <div class="space-y-6">
        {{-- Profile Information Form --}}
        <x-filament::card>
            <form wire:submit="updateProfile">
                {{ $this->profileForm }}
                
                <div class="mt-6">
                    <x-filament::button type="submit" color="primary">
                        <x-filament::loading-indicator wire:loading wire:target="updateProfile" class="h-5 w-5 mr-2"/>
                        Simpan Profile
                    </x-filament::button>
                </div>
            </form>
        </x-filament::card>
        
        {{-- Password Update Form --}}
        <x-filament::card>
            <form wire:submit="updatePassword">
                {{ $this->passwordForm }}
                
                <div class="mt-6">
                    <x-filament::button type="submit" color="primary">
                        <x-filament::loading-indicator wire:loading wire:target="updatePassword" class="h-5 w-5 mr-2"/>
                        Update Password
                    </x-filament::button>
                </div>
            </form>
        </x-filament::card>
    </div>
</x-filament-panels::page>
