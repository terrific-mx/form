<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\FormSubmissionController;
use App\Http\Controllers\FormThankYouController;

Volt::route('/', 'pages.welcome')->name('home');
Volt::route('pricing', 'pages.pricing')->name('pricing');
Volt::route('changelog', 'pages.changelog')->name('changelog');
Volt::route('connect', 'pages.connect')->name('connect');

Route::middleware(['auth', 'verified'])->group(function () {
    Volt::route('forms', 'pages.forms.index')->name('forms.index');
    Volt::route('forms/create', 'pages.forms.create')->name('forms.create');

    Volt::route('forms/{form}', 'pages.forms.show')->name('forms.show');
});

Route::post('/f/{form:ulid}', [FormSubmissionController::class, 'store'])->name('form-submissions.store');

Route::get('/f/{form:ulid}/thank-you', FormThankYouController::class)->name('forms.thank-you');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
