<div class="flex content-center justify-center h-full">
    <x-card class="flex content-center justify-center w-1/3 h-full ">
        <x-form wire:submit="submit" class="p-6 border-4 rounded-md border-blue-950">
            <x-input label="Nome" wire:model="name" />
            <x-input label="E-mail" wire:model="email" />
            <x-input label="E-mail Confirmação" wire:model="email_confirmation" />
            <x-input label="Senha" wire:model="password" />
            <x-slot:actions>
                <x-button label="Reset" />
                <x-button label="Registrar" class="btn-primary" type="submit" spinner="save" />
            </x-slot:actions>
        </x-form>
    </x-card>
</div>
