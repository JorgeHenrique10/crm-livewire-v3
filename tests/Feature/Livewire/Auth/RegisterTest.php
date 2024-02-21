<?php

namespace Tests\Feature\Livewire\Auth;

use App\Livewire\Auth\Register;
use App\Models\User;
use App\Notifications\WelcomeNotification;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Notification;
use Livewire\Livewire;

use function Pest\Laravel\{assertDatabaseCount, assertDatabaseHas};

it('should render component register', function () {
    Livewire::test(Register::class)
        ->assertOk();
});

it('should be able register user', function () {
    Livewire::test(Register::class)
        ->set('name', 'boy')
        ->set('email', 'boy@mailinator.com')
        ->set('email_confirmation', 'boy@mailinator.com')
        ->set('password', 'boy@123')
        ->call('submit')

        ->assertHasNoErrors()
        ->assertRedirect(RouteServiceProvider::HOME);

    assertDatabaseHas('users', [
        'name'  => 'boy',
        'email' => 'boy@mailinator.com',
    ]);

    assertDatabaseCount('users', 1);

    expect(auth()->check())
        ->and(auth()->user())->id
        ->toBe(User::first()->id);
});

test('validation form', function ($f) {
    if ($f->rule == 'unique') {
        User::factory()->create([$f->field => $f->value]);
    }

    $livewire = Livewire::test(Register::class)
        ->set($f->field, $f->value);

    if (property_exists($f, 'aValue')) {
        $livewire->set($f->aField, $f->aValue);
    }

    $livewire->call('submit')
        ->assertHasErrors([$f->field => $f->rule]);
})->with([
    'name::required'     => (object)['field' => 'name', 'value' => '', 'rule' => 'required'],
    'name::max:255'      => (object)['field' => 'name', 'value' => str_repeat('*', 256), 'rule' => 'max'],
    'email::required'    => (object)['field' => 'email', 'value' => '', 'rule' => 'required'],
    'email::email'       => (object)['field' => 'email', 'value' => 'not-an-email', 'rule' => 'email'],
    'email::max:255'     => (object)['field' => 'email', 'value' => str_repeat('*' . '@doe.com', 256), 'rule' => 'max'],
    'email::confirmed'   => (object)['field' => 'email', 'value' => 'joe@doe.com', 'rule' => 'confirmed'],
    'email::unique'      => (object)['field' => 'email', 'value' => 'joe@doe.com', 'rule' => 'unique', 'aField' => 'email_confirmation', 'aValue' => 'joe@doe.com'],
    'password::required' => (object)['field' => 'password', 'value' => '', 'rule' => 'required'],

]);

it('should send notification new user', function () {
    Notification::fake();
    Livewire::test(Register::class)
        ->set('name', 'boy')
        ->set('email', 'boy@mailinator.com')
        ->set('email_confirmation', 'boy@mailinator.com')
        ->set('password', 'boy@123')
        ->call('submit');

    $user = User::whereEmail('boy@mailinator.com')->first();

    Notification::assertSentTo($user, WelcomeNotification::class);
});
