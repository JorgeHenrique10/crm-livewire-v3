<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public ?string $email;

    public ?string $password;

    public function render()
    {
        return view('livewire.auth.login');
    }

    public function tryToLogin()
    {
        if (!Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            return;
        }

        $this->redirect(route('dashboard'));
    }
}
