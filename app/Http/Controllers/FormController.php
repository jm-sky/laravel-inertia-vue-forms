<?php

namespace App\Http\Controllers;

use App\Models\Form;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class FormController extends Controller
{
    public function index(): Response {
        return Inertia::render('Forms/Index', [
            'forms' => Form::all(),
        ]);
    }

    public function create(): Response {
        return Inertia::render('Forms/Create');
    }

    public function store(Request $request): RedirectResponse {
      $request->validate([
        'name' => 'required|max:128',
        'fields' => 'required',
        'fields.*.label' => 'required|max:128',
        'fields.*.type' => 'required',
        'fields.*.required' => 'required|boolean',
      ]);

        Form::create([
            'name' => $request->input('name'),
            'fields' => $request->input('fields'),
            'user_id' => $request->user?->id,
        ]);

        return redirect()->route('forms.index');
    }

    public function edit(Form $form): Response {
        return Inertia::render('Forms/Edit', [
            'form' => $form,
        ]);
    }

    public function update(Request $request, Form $form): RedirectResponse {
        $validated = $request->validate([
            'name' => 'required|max:128',
            'fields' => 'required',
            'fields.*.label' => 'required|max:128',
            'fields.*.type' => 'required',
            'fields.*.required' => 'required|boolean',
          ]);

        $form->update($validated);

        return redirect()->route('forms.edit', [ 'form' => $form ]);
    }

    public function delete(Form $form): RedirectResponse {
        $form->delete();

        return redirect()->route('forms.index');
    }

    public function show(Form $form): Response {
        return Inertia::render('Forms/Show', [
            'form' => $form,
        ]);
    }
}
