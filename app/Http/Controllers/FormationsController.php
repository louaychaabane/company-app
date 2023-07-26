<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Formation;
use App\Models\RhMember;


class FormationsController extends Controller
{
    public function updateForm($id)
    {
        $formation = Formation::findOrFail($id);
        return view('update-formation', compact('formation'));
    }

    // Update a specific formation in the database
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string',
            'start_date' => 'required|date',
            'trainer' => 'required|string',
            'specialite' => 'required|string|in:Informatique,Electricité,Chimie,Finance',
            'hours' => 'required|integer',
        ]);

        $formation = Formation::findOrFail($id);

        $formation->title = $request->input('title');
        $formation->start_date = $request->input('start_date');
        $formation->trainer = $request->input('trainer');
        $formation->specialite = $request->input('specialite');
        $formation->hours = $request->input('hours');


        // Save the updated formation
        $formation->save();

        
        // Redirect back to the list of formations with a success message
        return redirect()->route('rhDashboard')->with('success', 'Formation updated successfully');
    }

    // Delete a specific formation from the database
    public function destroy($id)
    {
        $formation = Formation::findOrFail($id);
        // Delete the formation from the database here
        $formation->delete();
        // Redirect back to the list of formations with a success message
        return redirect()->route('rhDashboard')->with('success', 'Formation deleted successfully');
    }

    public function create()
    {
        return view('create-formation');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'start_date' => 'required|date',
            'trainer' => 'required|string',
            'specialite' => 'required|string',
            'hours' => 'required|integer',
        ]);

        Formation::create([
            'title' => $request->title,
            'start_date' => $request->start_date,
            'trainer' => $request->trainer,
            'specialite' => $request->specialite,
            'hours' => $request->hours,
        ]);

        return redirect()->route('rhDashboard')->with('success', 'Formation added successfully');
    }
}
