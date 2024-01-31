<?php

use App\Livewire\Auth\Login;
use App\Models\User;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(Login::class)
        ->assertStatus(200);
});

it('should be able to login', function () {

    $user = User::factory()->create([
        'email'    => 'boy@mailinator.com',
        'password' => 'password',
    ]);

    Livewire::test(Login::class)
        ->set('email', 'boy@mailinator.com')
        ->set('password', 'password')
        ->call('tryToLogin')
        ->assertHasNoErrors();

    expect(auth()->check())->toBeTrue()
        ->and(auth()->user())->id->toBe($user->id);
});
