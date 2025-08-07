<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Form;
use App\Models\Submission;

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

