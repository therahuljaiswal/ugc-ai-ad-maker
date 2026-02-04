<?php

namespace App\Http\Controllers;

use App\Models\Prompt;
use Illuminate\Http\Request;

class AdminPromptController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.prompts.index', [
            'prompts' => Prompt::latest()->paginate(20),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.prompts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'type' => 'required|in:video,image',
            'is_preset' => 'boolean',
        ]);

        Prompt::create($request->all());

        return redirect()->route('admin.prompts.index')->with('success', 'Prompt created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Prompt $prompt)
    {
        return view('admin.prompts.edit', compact('prompt'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Prompt $prompt)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'type' => 'required|in:video,image',
            'is_preset' => 'boolean',
        ]);

        $prompt->update($request->all());

        return redirect()->route('admin.prompts.index')->with('success', 'Prompt updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Prompt $prompt)
    {
        $prompt->delete();

        return redirect()->route('admin.prompts.index')->with('success', 'Prompt deleted successfully.');
    }
}
