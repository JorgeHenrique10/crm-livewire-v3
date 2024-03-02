<?php

use App\Livewire\Auth\Login;
use App\Models\User;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(Login::class)
        ->assertSeeLivewire('auth.password.recovery');
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
        ->assertHasNoErrors()
        ->assertRedirect(route('dashboard'));

    expect(auth()->check())->toBeTrue()
        ->and(auth()->user())->id->toBe($user->id);
});

it('should make sure to inform the user an error when email and password doesnt work', function () {

    Livewire::test(Login::class)
        ->set('email', 'boy@mailinator.com')
        ->set('password', 'password')
        ->call('tryToLogin')
        ->assertHasErrors(['invalidCredentials'])
        ->assertSee(trans('auth.failed'));
});

it('should make sure to inform the user an error when rate limit', function () {

    $user = User::factory()->create();

    for ($i = 0; $i < 5; $i++) {
        Livewire::test(Login::class)
            ->set('email', 'boy@mailinator.com')
            ->set('password', 'password')
            ->call('tryToLogin')
            ->assertHasErrors(['invalidCredentials'])
            ->assertSee(trans('auth.failed'));
    }

    Livewire::test(Login::class)
        ->set('email', 'boy@mailinator.com')
        ->set('password', 'password')
        ->call('tryToLogin')
        ->assertHasErrors(['rateLimiter']);
});
