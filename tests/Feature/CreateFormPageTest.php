<?php

use App\Models\User;
use function Pest\Laravel\actingAs;
use Livewire\Volt\Volt;
use App\Models\Form;

it('shows the create form page to authenticated, verified users', function () {
    $user = User::factory()->create(['email_verified_at' => now()]);

    actingAs($user)
        ->get('/forms/create')
        ->assertOk()
        ->assertSee('Enter form name')
        ->assertSee('Create Form');
});

it('creates a form with valid data', function () {
    $user = User::factory()->create(['email_verified_at' => now()]);

    $component = Volt::actingAs($user)
        ->test('pages.forms.create')
        ->set('name', 'My Test Form')
        ->call('submit');

    $component->assertRedirect(route('forms.index'));

    $form = Form::first();
    expect($form)->not->toBeNull();
    expect($form->name)->toBe('My Test Form');
    expect($form->user->is($user))->toBeTrue();
});

it('shows validation errors when required fields are missing', function () {
    $user = User::factory()->create(['email_verified_at' => now()]);

    Volt::actingAs($user)
        ->test('pages.forms.create')
        ->set('name', '')
        ->call('submit')
        ->assertHasErrors(['name']);
});
