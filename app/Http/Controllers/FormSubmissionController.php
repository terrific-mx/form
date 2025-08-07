<?php

namespace App\Http\Controllers;

use App\Models\Form;
use Illuminate\Http\Request;

class FormSubmissionController extends Controller
{
    public function store(Request $request, Form $form)
    {
        $form->submissions()->create([
            'data' => $request->all(),
        ]);

        return redirect("/f/{$form->ulid}/thank-you");
    }
}
