<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreConferenceRequest;
use App\Http\Requests\UpdateConferenceRequest;
use App\Models\Conference;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ConferenceController extends Controller
{
    public function index(): View
    {
        return view('conferences.index', [
            'conferences' => Conference::orderBy('date')->paginate(9),
        ]);
    }

    public function show(Conference $conference): View
    {
        return view('conferences.show', compact('conference'));
    }

    public function create(): View
    {
        return view('conferences.create');
    }

    public function store(StoreConferenceRequest $request): RedirectResponse
    {
        Conference::create($request->validated());

        return redirect()->route('conferences.index')->with('success', __('messages.created'));
    }

    public function edit(Conference $conference): View
    {
        return view('conferences.edit', compact('conference'));
    }

    public function update(UpdateConferenceRequest $request, Conference $conference): RedirectResponse
    {
        $conference->update($request->validated());

        return redirect()->route('conferences.index')->with('success', __('messages.updated'));
    }

    public function destroy(Conference $conference): RedirectResponse
    {
        $conference->delete();

        return redirect()->route('conferences.index')->with('success', __('messages.deleted'));
    }
}
