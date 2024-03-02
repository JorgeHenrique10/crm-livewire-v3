<?php

use App\Livewire\Auth\Password\Recovery;
use App\Livewire\Auth\{Login, Register};
use App\Livewire\Welcome;
use Illuminate\Support\Facades\{Auth, Route};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/register', Register::class)->name('auth.register');
Route::get('/login', Login::class)->name('login');
Route::get('/logout', function () {
    Auth::logout();
})->name('auth.logout');
Route::get('/password/recovery', Recovery::class)->name('auth.password.recovery');

Route::middleware('auth')->group(function () {
    Route::get('/', Welcome::class)->name('dashboard');
});
