<?php

use App\Models\Form;
use App\Models\User;
use Livewire\Volt\Volt;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

describe('Form Index Page Access', function () {
    it('redirects guests to the login page', function () {
        get(route('forms.index'))->assertRedirect(route('login'));
    });

    it('allows authenticated users to access the page', function () {
        actingAs(User::factory()->create());

        get(route('forms.index'))->assertOk();
    });
});

it('shows only the authenticated user\'s forms on the index page', function () {
    $user = User::factory()->create();
    $otherUser = User::factory()->create();

    $formA = Form::factory()->create(['user_id' => $user->id, 'name' => 'User Form 1']);
    $formB = Form::factory()->create(['user_id' => $user->id, 'name' => 'User Form 2']);
    $formC = Form::factory()->create(['user_id' => $otherUser->id, 'name' => 'Other User Form']);

    Volt::actingAs($user)
        ->test('pages.forms.index')
        ->assertSee('User Form 1')
        ->assertSee('User Form 2')
        ->assertDontSee('Other User Form');
});
