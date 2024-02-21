<div class="flex items-center content-center justify-center h-full">
    <x-card title="Register" class="flex content-center justify-center w-2/5 bg-gray-900 h-max">
        <x-form wire:submit="submit" class="p-6 border-4 rounded-md border-blue-950">
            <x-input label="Nome" wire:model="name" />
            <x-input label="E-mail" wire:model="email" />
            <x-input label="E-mail Confirmação" wire:model="email_confirmation" />
            <x-input label="Senha" wire:model="password" type="password" />
            <x-slot:actions class="flex flex-row">
                <div class="flex items-center w-full pl-0 ml-0">
                    <a wire:navigation href="{{ route('login') }}" class="link link-primary">I already hare an
                        account</a>
                </div>
                <div class="flex">
                    <x-button label="Reset" class="btn" />
                    <x-button label="Registrar" class="btn-primary" type="submit" spinner="save" />
                </div>
            </x-slot:actions>
        </x-form>
    </x-card>
</div>
