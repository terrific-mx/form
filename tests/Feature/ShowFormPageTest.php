<?php

use App\Models\User;
use App\Models\Form;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

it('allows an authenticated user to view their own form', function () {
    $user = User::factory()->create();
    $form = Form::factory()->for($user)->create();

    actingAs($user);
    $response = get("/forms/{$form->id}");

    $response->assertStatus(200);
});
