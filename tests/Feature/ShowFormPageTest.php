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

it('forbids access to a form not owned by the user', function () {
    $owner = User::factory()->create();
    $intruder = User::factory()->create();
    $form = Form::factory()->for($owner)->create();

    actingAs($intruder);
    $response = get("/forms/{$form->id}");

    $response->assertStatus(403);
});
