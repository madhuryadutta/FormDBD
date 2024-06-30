<?php

namespace App\Http\Controllers;

use App\Models\Form;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FormEntryController extends Controller
{
    public function store(Request $request, $formId)
    {
        $request->validate([
            'domain' => 'required|in:yourdomain.com',
            'publishableSecretKey' => 'required|in:yourpublishablesecretkey',
        ]);

        $form = Form::with('fields')->findOrFail($formId);

        $validatedData = $request->validate(
            collect($form->fields)->mapWithKeys(function ($field) {
                return [$field->name => 'required'];
            })->toArray()
        );

        $entry = $form->entries()->create(['data' => $validatedData, 'submitted_at' => Carbon::now()]);

        return response()->json(['message' => 'Form submitted successfully'], 201);
    }
}
