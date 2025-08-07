<?php

use App\Models\User;
use function Pest\Laravel\actingAs;

it('shows the create form page to authenticated, verified users', function () {
    $user = User::factory()->create(['email_verified_at' => now()]);

    actingAs($user)
        ->get('/forms/create')
        ->assertOk()
        ->assertSee('Enter form name')
        ->assertSee('Create Form');
});
