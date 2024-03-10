<div class="flex items-center justify-center h-full">
    <x-card title="Recovery Password" class="flex content-center justify-center w-2/5 bg-gray-900 h-max">

        <div class="mb-5">
            @if ($message)
                <x-alert icon="o-exclamation-triangle" class="alert-warning">
                    <span>You will receve an email with the password recovery link</span>
                </x-alert>
            @endif
        </div>

        <x-form wire:submit="startPasswordRecovery" class="p-6 border-4 rounded-md border-blue-950">
            <x-input label="E-mail" wire:model="email" />
            <div class="flex flex-col w-full text-xs text-end">
                <a wire:navigation href="{{ route('login') }}" class="link link-primary">Never mind, get back
                    to login page.</a>
            </div>
            <x-slot:actions class="flex flex-row">
                <div>
                    {{-- <x-button label="Reset" /> --}}
                    <x-button label="Submit" class="btn-primary" type="submit" spinner="save" />
                </div>
            </x-slot:actions>
        </x-form>
    </x-card>
</div>
