<?php

use App\Http\Livewire\Dashboard;
use App\Http\Livewire\ListMembers;
use App\Http\Livewire\ListRoles;
use App\Http\Livewire\Login;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', fn() => redirect()->route('login'));

Route::middleware('guest')->group(function () {
    Route::get('login', Login::class)->name('login');
});

Route::middleware('auth')->group(function () {
    Route::prefix('app')->group(function () {
        Route::get('dashboard', Dashboard::class)->name('app.dashboard');
        Route::prefix('members')->group(function () {
            Route::get('list', ListMembers::class)->name('app.members-list');
        });
        Route::prefix('roles')->group(function () {
            Route::get('list', ListRoles::class)->name('app.roles-list');
        });
    });
    Route::get('logout', function () {
        auth()->logout();
        return redirect()->route('login');
    })->name('logout');
});

// Route::get('members/list', MembersList::class);