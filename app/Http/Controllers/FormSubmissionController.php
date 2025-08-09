<?php

namespace App\Http\Controllers;

use App\Models\Form;
use Illuminate\Http\Request;

class FormSubmissionController extends Controller
{
    public function store(Request $request, Form $form)
    {
        $submission = $form->submissions()->create([
            'data' => $request->all(),
        ]);

        // Minimal: notify form owner
        if ($form->user) {
            $form->user->notify(new \App\Notifications\FormSubmissionReceived($form, $submission));
        }

        return redirect("/f/{$form->ulid}/thank-you");
    }
}
