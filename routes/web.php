<?php

use App\Http\Livewire\App\Dashboard;
use App\Http\Livewire\App\ListMembers;
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

Route::get('/', fn() => view('home'));

Route::middleware('guest')->group(function () {
    Route::get('login', Login::class)->name('login');
});

Route::middleware('auth')->group(function () {
    Route::prefix('app')->group(function () {
        Route::get('dashboard', Dashboard::class)->name('app.dashboard');
        Route::prefix('member')->group(function () {
            Route::get('list', ListMembers::class)->name('app.members-list');
        });
    });
    Route::get('logout', function () {
        auth()->logout();
        return redirect()->route('login');
    })->name('logout');
});

// Route::get('members/list', MembersList::class);