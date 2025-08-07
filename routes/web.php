<?php
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Models\Form;
use App\Models\Submission;
use Illuminate\Http\Request;

Volt::route('/', 'pages.welcome')->name('home');
Volt::route('pricing', 'pages.pricing')->name('pricing');
Volt::route('changelog', 'pages.changelog')->name('changelog');
Volt::route('connect', 'pages.connect')->name('connect');

Route::middleware(['auth', 'verified'])->group(function () {
    Volt::route('forms', 'pages.forms.index')->name('forms.index');
    Volt::route('forms/create', 'pages.forms.create')->name('forms.create');
});

Route::post('/f/{form:ulid}', function (Request $request, Form $form) {
    $submission = $form->submissions()->create([
        'data' => $request->all(),
    ]);
    return response()->json(['id' => $submission->id], 200);
});

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
