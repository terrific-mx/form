<?php

use App\Http\Controllers\FormSubmissionController;
use App\Http\Controllers\FormThankYouController;
use App\Http\Middleware\EnsureUserIsSubscribed;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Volt::route('/', 'pages.welcome')->name('home');
Volt::route('pricing', 'pages.pricing')->name('pricing');
Volt::route('changelog', 'pages.changelog')->name('changelog');
Volt::route('connect', 'pages.connect')->name('connect');

Route::middleware(['auth', 'verified', EnsureUserIsSubscribed::class])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');

    Volt::route('forms', 'pages.forms.index')->name('forms.index');
    Volt::route('forms/create', 'pages.forms.create')->name('forms.create');

    Volt::route('forms/{form}', 'pages.forms.show')->name('forms.show');
});

Route::post('/f/{form:ulid}', [FormSubmissionController::class, 'store'])->name('form-submissions.store');

Route::get('/f/{form:ulid}/thank-you', FormThankYouController::class)->name('forms.thank-you');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Volt::route('subscribe', 'pages.subscribe')->name('subscribe');
    Volt::route('subscription-required', 'pages.subscription-required')->name('subscription-required');
});

require __DIR__.'/auth.php';
