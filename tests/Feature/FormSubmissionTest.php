<?php

use App\Models\Form;
use App\Models\Submission;
use App\Models\User;
use App\Notifications\FormSubmissionReceived;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;

use function Pest\Laravel\post;

uses(RefreshDatabase::class);

describe('Form Submission', function () {
    it('allows posting to /f/{ulid} and returns a valid response', function () {
        $form = Form::factory()->create();

        $response = post("/f/{$form->ulid}", [
            'field1' => 'value1',
            'field2' => 'value2',
        ]);

        $response->assertRedirect("/f/{$form->ulid}/thank-you");
    });

    it('stores form responses via /f/{ulid}', function () {
        $form = Form::factory()->create();
        $payload = [
            'field1' => 'test value',
            'field2' => 'another value',
        ];

        post("/f/{$form->ulid}", $payload)
            ->assertRedirect("/f/{$form->ulid}/thank-you");

        $submission = Submission::first();
        expect($submission)->not->toBeNull();
        expect($submission->form->is($form))->toBeTrue();
        expect($submission->data)->toMatchArray([
            'field1' => 'test value',
            'field2' => 'another value',
        ]);
    });

    it('sends a notification to the form owner when a new submission is received', function () {
        Notification::fake();

        $owner = User::factory()->create(['email' => 'owner@example.com']);
        $form = Form::factory()->for($owner)->create();
        $payload = [
            'field1' => 'notify value',
            'field2' => 'another notify',
        ];

        post("/f/{$form->ulid}", $payload)
            ->assertRedirect("/f/{$form->ulid}/thank-you");

        $submission = Submission::first();

        Notification::assertSentTo(
            $owner,
            FormSubmissionReceived::class,
            function ($notification, $channels) use ($form, $submission) {
                return $notification->form->is($form)
                    && $notification->submission->is($submission);
            }
        );
    });
});
