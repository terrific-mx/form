<?php

use App\Models\User;
use function Pest\Laravel\get;
use function Pest\Laravel\actingAs;

describe('Form Index Page Access', function () {
    it('redirects guests to the login page', function () {
        get(route('forms.index'))->assertRedirect(route('login'));
    });

    it('allows authenticated users to access the page', function () {
        actingAs(User::factory()->create());

        get(route('forms.index'))->assertOk();
    });
});
