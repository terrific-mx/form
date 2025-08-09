<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Notifications\FormSubmissionReceived;
use Illuminate\Http\Request;

class FormSubmissionController extends Controller
{
    public function store(Request $request, Form $form)
    {
        $submission = $form->submissions()->create([
            'data' => $request->all(),
        ]);

        $form->user->notify(new FormSubmissionReceived($form, $submission));

        return redirect("/f/{$form->ulid}/thank-you");
    }
}
