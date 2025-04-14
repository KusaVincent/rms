<?php

declare(strict_types=1);

use App\Livewire\Detail;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function (): void {
    Route::view('/', 'tenant-entry')->name('home');
    Route::view('/about', 'tenant-entry')->name('about');
    Route::view('/contact', 'tenant-entry')->name('contact');
    Route::view('/properties', 'tenant-entry')->name('properties');
    Route::get('/property-details/{id}', Detail::class)->name('details');
});

Route::middleware(['auth'])->group(function (): void {
    Route::view('/profile', 'profile')->name('profile');
    Route::view('/dashboard', 'dashboard')->middleware('verified')->name('dashboard');
});

require __DIR__.'/auth.php';
