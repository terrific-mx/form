<?php

use App\Models\Form;
use App\Models\Submission;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\post;

uses(RefreshDatabase::class);

describe('Form Submission', function () {
    it('allows posting to /f/{ulid} and returns a valid response', function () {
        // Create a form with a ULID
        $form = Form::factory()->create();

        $response = post("/f/{$form->ulid}", [
            // Example payload, adjust as needed
            'field1' => 'value1',
            'field2' => 'value2',
        ]);

        $response->assertStatus(200);
    });

    it('stores form responses via /f/{ulid}', function () {
        $form = Form::factory()->create();
        $payload = [
            'field1' => 'test value',
            'field2' => 'another value',
        ];

        post("/f/{$form->ulid}", $payload)
            ->assertStatus(200);

        // Assert the first FormSubmission exists and has the expected data
        $submission = Submission::first();
        expect($submission)->not->toBeNull();
        expect($submission->form->is($form))->toBeTrue();
        expect($submission->data)->toMatchArray([
            'field1' => 'test value',
            'field2' => 'another value',
        ]);
    });
});
