<?php

namespace App\Http\Controllers;

use App\Models\Form;

class FormThankYouController extends Controller
{
    public function __invoke(Form $form)
    {
        return 'Thank you for your submission.';
    }
}
