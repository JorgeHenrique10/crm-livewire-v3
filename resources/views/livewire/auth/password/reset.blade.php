<div class="flex items-center justify-center h-full">
    <x-card title="Reset Password" class="flex content-center justify-center w-2/5 bg-gray-900 h-max">

        <x-form wire:submit="updatePassword" class="p-6 border-4 rounded-md border-blue-950">
            <x-input label="E-mail" value="{{ $this->obfuscatedEmail }}" />
            <x-input label="E-mail" wire:model="email_confirmation" />
            <x-input label="Nem Password" wire:model="password" type="password" />
            <x-input label="New Password Confirmation" wire:model="password_confirmation" type="password" />

            <x-slot:actions class="flex flex-row">
                <div>
                    {{-- <x-button label="Reset" /> --}}
                    <x-button label="Reset" class="btn-primary" type="submit" spinner="save" />
                </div>
            </x-slot:actions>
        </x-form>
    </x-card>
</div>
