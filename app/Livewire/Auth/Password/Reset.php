<?php

namespace App\Livewire\Auth\Password;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\{DB, Hash};
use Livewire\Component;

class Reset extends Component
{
    public ?string $token = null;

    public function mount(): void
    {
        $this->token = request('token');

        if ($this->tokenNotValid()) {
            session()->flash('status', 'Token Inválid!');
            $this->redirectRoute('login');
        }
    }

    public function render(): View
    {
        return view('livewire.auth.password.reset');
    }

    private function tokenNotValid(): bool
    {
        $tokens = DB::table('password_reset_tokens')
            ->get();

        foreach ($tokens as $t) {
            if (Hash::check($this->token, $t->token)) {
                return false;
            }
        }

        return true;
    }
}