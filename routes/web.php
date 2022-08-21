<?php

use App\Http\Livewire\Dashboard;
use App\Http\Livewire\Members;
use App\Http\Livewire\Roles;
use App\Http\Livewire\Churches;
use App\Http\Livewire\Login;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => redirect()->route('login'));

Route::middleware('guest')->group(function () {
    Route::get('login', Login::class)->name('login');
});

Route::middleware('auth')->group(function () {

    Route::prefix('app')->group(function () {

        Route::get('painel', Dashboard::class)->name('app.dashboard');

        Route::middleware('isAdmin')->group(function () {
            Route::get('membros', Members\Index::class)->name('app.members');
            Route::get('cargos', Roles\Index::class)->name('app.roles');
            Route::get('igrejas', Churches\Index::class)->name('app.churches');
        });

    });

    Route::get('logout', function () {
        auth()->logout();
        return redirect()->route('login');
    })->name('logout');
});

// Route::get('members/list', MembersList::class);