<?php

namespace App\Http\Controllers;

use App\Models\Form;
use Illuminate\Http\Request;

class FormController extends Controller
{
    public function index()
    {
        $forms = Form::with('fields')->get();

        return view('forms.index', compact('forms'));
    }

    public function create()
    {
        return view('forms.create');
    }

    public function store(Request $request)
    {
        $form = Form::create($request->only('name'));

        return redirect()->route('forms.index');
    }

    public function show($id)
    {
        $form = Form::with('fields')->findOrFail($id);

        return view('forms.show', compact('form'));
    }

    public function generateCode($id)
    {
        $form = Form::with('fields')->findOrFail($id);

        return view('forms.generate-code', compact('form'));
    }
}
