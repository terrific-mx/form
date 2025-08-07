<?php

use App\Models\Form;
use App\Models\User;
use App\Models\Submission;
use Livewire\Volt\Volt;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

it('allows an authenticated user to view their own form', function () {
    $user = User::factory()->withSubscription()->create();
    $form = Form::factory()->for($user)->create();

    actingAs($user);
    $response = get("/forms/{$form->id}");

    $response->assertStatus(200);
});

it('forbids access to a form not owned by the user', function () {
    $owner = User::factory()->withSubscription()->create();
    $intruder = User::factory()->withSubscription()->create();
    $form = Form::factory()->for($owner)->create();

    actingAs($intruder);
    $response = get("/forms/{$form->id}");

    $response->assertStatus(403);
});

it('allows a user to view their own form submission via Volt action', function () {
    $user = User::factory()->withSubscription()->create();
    $form = Form::factory()->for($user)->create();
    $submission = Submission::factory()->for($form)->create();

    actingAs($user);

    Volt::test('pages.forms.show', ['form' => $form])
        ->call('showSubmissionModal', $submission)
        ->assertSet('selectedSubmission.id', $submission->id);
});

it('forbids a user from viewing a submission for a form they do not own via Volt action', function () {
    $owner = User::factory()->withSubscription()->create();
    $intruder = User::factory()->withSubscription()->create();

    $intruderForm = Form::factory()->for($intruder)->create();
    $ownersForm = Form::factory()->for($owner)->create();
    $ownersSubmission = Submission::factory()->for($ownersForm)->create();

    actingAs($intruder);

    Volt::test('pages.forms.show', ['form' => $intruderForm])
        ->call('showSubmissionModal', $ownersSubmission)
        ->assertForbidden();
});
