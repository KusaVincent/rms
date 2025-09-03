<?php

declare(strict_types=1);

use App\Livewire\Detail;
use App\Mail\PreviewSupportAcknowledgementMail;
use App\Models\CustomerSupport;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function (): void {
    Route::view('/', 'tenant-entry')->name('home');
    Route::view('/about', 'tenant-entry')->name('about');
    Route::view('/contact', 'tenant-entry')->name('contact');
    Route::view('/properties', 'tenant-entry')->name('properties');
    Route::get('/property-details/{slug}', Detail::class)->name('details');
});

Route::middleware('auth')->group(function (): void {
    Route::view('/profile', 'profile')->name('profile');
    Route::view('/dashboard', 'dashboard')->middleware('verified')->name('dashboard');
});

Route::get('/preview-support-email', function () {
    $support = CustomerSupport::first(); // or use a fake model instance for preview
    return (new PreviewSupportAcknowledgementMail($support))->render();
});

require __DIR__.'/auth.php';
