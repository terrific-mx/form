<?php

use App\Models\Form;
use App\Models\User;
use Livewire\Volt\Volt;

use function Pest\Laravel\actingAs;

it('shows the create form page to authenticated, verified users', function () {
    $user = User::factory()->withSubscription()->create();

    actingAs($user)
        ->get('/forms/create')
        ->assertOk()
        ->assertSee('Enter form name')
        ->assertSee('Create Form');
});

it('creates a form with valid data', function () {
    $user = User::factory()->withSubscription()->create();

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
    $user = User::factory()->withSubscription()->create();

    Volt::actingAs($user)
        ->test('pages.forms.create')
        ->set('name', '')
        ->call('submit')
        ->assertHasErrors(['name']);
});

it('assigns a ULID to each new form', function () {
    $user = User::factory()->withSubscription()->create();

    Volt::actingAs($user)
        ->test('pages.forms.create')
        ->set('name', 'Form With ULID')
        ->call('submit');

    $form = Form::first();
    expect($form)->not->toBeNull();
    expect($form->ulid)->not->toBeEmpty();
});
