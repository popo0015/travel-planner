<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    public function index()
    {
        $destinations = Destination::all();
        return view('destinations.index', compact('destinations'));
    }

    public function create()
    {
        return view('destinations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:25',
            'location' => 'required|string|max:255',
            'visit_date' => 'required|date|after:today',
            'reason' => 'required|string|in:work,holiday,study,relatives,event,other',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ], [
            'name.required' => 'The name field is required.',
            'location.required' => 'The location field is required.',
            'visit_date.required' => 'The visit date field is required.',
            'visit_date.after' => 'The visit date must be a future date.',
            'reason.required' => 'The reason field is required.',
            'reason.in' => 'The selected reason is invalid.',
            'latitude.required' => 'The latitude field is required.',
            'longitude.required' => 'The longitude field is required.',
        ]);

        Destination::create($request->all());

        return redirect()->route('destinations.index')->with('success', 'Destination created successfully.');
    }

    public function show(Destination $destination)
    {
        return view('destinations.show', compact('destination'));
    }

    public function edit(Destination $destination)
    {
        return view('destinations.edit', compact('destination'));
    }

    public function update(Request $request, Destination $destination)
    {
        $request->validate([
            'name' => 'required|string|max:25',
            'visit_date' => 'required|date|after:today',
            'reason' => 'required|string|in:work,holiday,study,relatives,event,other',
        ]);

        $destination->update($request->all());

        return redirect()->route('destinations.index')->with('success', 'Destination updated successfully.');
    }

    public function destroy(Destination $destination)
    {
        $destination->delete();
        return redirect()->route('destinations.index')->with('success', 'Destination deleted successfully.');
    }
}
