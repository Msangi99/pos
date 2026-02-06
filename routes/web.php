<?php

use App\Livewire\Home;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Auth\ForgotPassword;
use Illuminate\Support\Facades\Route;

use App\Livewire\Admin\Dashboard as AdminDashboard;
use App\Livewire\Cashier\Dashboard as CashierDashboard;

Route::get('/', Home::class)->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/login', Login::class)->name('login');
    Route::get('/register', Register::class)->name('register');
    Route::get('/forgot-password', ForgotPassword::class)->name('password.request');
});

Route::middleware('auth')->group(function () {
    // Admin Routes
    Route::prefix('admin')->middleware('role:admin')->group(function () {
        Route::get('/dashboard', AdminDashboard::class)->name('admin.dashboard');
        Route::get('/inventory', \App\Livewire\Admin\Inventory::class)->name('admin.inventory');
        Route::get('/categories', \App\Livewire\Admin\Categories::class)->name('admin.categories');
        Route::get('/sales', \App\Livewire\Admin\Sales::class)->name('admin.sales');
        Route::get('/users', \App\Livewire\Admin\Users::class)->name('admin.users');
        Route::get('/reports', \App\Livewire\Admin\Reports::class)->name('admin.reports');
        Route::get('/settings', \App\Livewire\Admin\Settings::class)->name('admin.settings');
    });

    // Cashier Routes
    Route::prefix('cashier')->middleware('role:cashier')->group(function () {
        Route::get('/dashboard', CashierDashboard::class)->name('cashier.dashboard');
        Route::get('/pos', \App\Livewire\Cashier\Pos::class)->name('cashier.pos');
        Route::get('/sales', \App\Livewire\Cashier\Sales::class)->name('cashier.sales');
    });
    // Default redirect if someone hits /dashboard
    Route::get('/dashboard', function() {
        return auth()->user()->role === 'admin' 
            ? redirect()->route('admin.dashboard') 
            : redirect()->route('cashier.dashboard');
    })->name('dashboard');

    Route::post('/logout', function () {
        auth()->logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect('/');
    })->name('logout');
});
