<?php

use App\Livewire\Auth\Password\Recovery;
use App\Models\User;
use App\Notifications\PasswordRecoveryNotification;
use Illuminate\Support\Facades\Notification;
use Livewire\Livewire;

use function Pest\Laravel\{assertDatabaseCount, assertDatabaseHas, get};

test('needs to have a route to password recovery', function () {
    get(route('auth.password.recovery'))
        ->assertSeeLivewire('auth.password.recovery');
});

it('should be able to request for a password recovery sending notification to the user', function () {
    Notification::fake();
    $user = User::factory()->create();

    Livewire::test(Recovery::class)
        ->assertDontSee('You will receve an email with the password recovery link')
        ->set('email', $user->email)
        ->call('startPasswordRecovery')
        ->assertSee('You will receve an email with the password recovery link');

    Notification::assertSentTo($user, PasswordRecoveryNotification::class);
});

test('email property', function ($value, $rule) {
    Livewire::test(Recovery::class)
        ->set('email', $value)
        ->call('startPasswordRecovery')
        ->assertHasErrors('email', $rule);
})->with([
    'required' => ['value' => '', 'rule' => 'required'],
    'email'    => ['value' => 'any email', 'rule' => 'email'],
]);

test('needs send token to password recovery', function () {

    $user = User::factory()->create();

    Livewire::test(Recovery::class)
        ->set('email', $user->email)
        ->call('startPasswordRecovery');

    assertDatabaseCount('password_reset_tokens', 1);
    assertDatabaseHas('password_reset_tokens', ['email' => $user->email]);
});
