<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\FormField;
use Illuminate\Http\Request;

class FormFieldController extends Controller
{
    public function create($formId)
    {
        $form = Form::findOrFail($formId);

        return view('fields.create', compact('form'));
    }

    public function store(Request $request, $formId)
    {
        $form = Form::findOrFail($formId);
        $form->fields()->create($request->only('label', 'name', 'type'));

        return redirect()->route('forms.show', $formId);
    }

    // public function edit(Form $form, FormField $field)
    public function edit($formId, $fieldId)
    {
        $form = Form::findOrFail($formId);
        $field = FormField::findOrFail($fieldId);

        return view('fields.edit', compact('form', 'field'));
    }

    public function update(Request $request, Form $form, FormField $field)
    {
        $request->validate([
            'label' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:255',
        ]);

        $field->update($request->only('label', 'name', 'type'));

        return redirect()->route('forms.show', $form->id)->with('success', 'Field updated successfully.');
    }
}
