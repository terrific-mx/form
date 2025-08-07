<?php

use App\Models\User;
use function Pest\Laravel\actingAs;

test('authenticated, verified user can view the create form page', function () {
    $user = User::factory()->create(['email_verified_at' => now()]);

    actingAs($user)
        ->get('/forms/create')
        ->assertOk()
        ->assertSee('Enter form name')
        ->assertSee('Create Form');
});
