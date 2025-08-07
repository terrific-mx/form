<?php

use App\Models\Form;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\get;

uses(RefreshDatabase::class);

describe('Form Thank You Page', function () {
    it('is accessible via /f/{ulid}/thank-you', function () {
        $form = Form::factory()->create();

        $response = get("/f/{$form->ulid}/thank-you");

        $response->assertStatus(200);
        // Optionally, check for content:
        // $response->assertSee('Thank you');
    });
});
