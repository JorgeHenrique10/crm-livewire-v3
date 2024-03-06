<div class="flex items-center justify-center h-full">
    <x-card title="Login" class="flex content-center justify-center w-2/5 bg-gray-900 h-max">

        <div class="mb-5">
            @if ($message = session()->get('status'))
                <x-alert icon="o-exclamation-triangle" class="alert-error">
                    <span>{{ $message }}</span>
                </x-alert>
            @endif
            @if ($errors->hasAny(['invalidCredentials', 'rateLimiter']))
                <x-alert icon="o-exclamation-triangle" class="alert-warning">
                    @error('invalidCredentials')
                        <span>{{ $message }}</span>
                    @enderror
                    @error('rateLimiter')
                        <span>{{ $message }}</span>
                    @enderror
                </x-alert>
            @endif
        </div>

        <x-form wire:submit="tryToLogin" class="p-6 border-4 rounded-md border-blue-950">
            <x-input label="E-mail" wire:model="email" />
            <x-input label="Senha" wire:model="password" type='password' />
            <div class="flex justify-end w-full text-xs ">
                <a wire:navigation href="{{ route('auth.password.recovery') }}" class="link link-primary">Forgout your
                    password? </a>
            </div>

            <x-slot:actions class="flex flex-row">
                <div class="flex items-center w-full pl-0 ml-0">
                    <a wire:navigation href="{{ route('auth.register') }}" class="link link-primary">I want to create an
                        account</a>
                </div>
                <div>
                    {{-- <x-button label="Reset" /> --}}
                    <x-button label="Logar" class="btn-primary" type="submit" spinner="save" />
                </div>
            </x-slot:actions>
        </x-form>
    </x-card>
</div>
