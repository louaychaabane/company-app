<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Conge;
use App\Models\Mission;
use App\Models\AppliedFormation;
use Carbon\Carbon;

class ReminderController extends Controller
{
    //
    public function index()
    {
        // Get upcoming conges, formations, missions, and applied formations
        $conges = Conge::where('id_employee', session('id_employee'))
            ->whereDate('start_date', '>', Carbon::now())
            ->get();

        $missions = Mission::where('id_employee', session('id_employee'))
            ->whereDate('start_date', '>', Carbon::now())
            ->get();

        $appliedFormations = AppliedFormation::where('id_employee', session('id_employee'))
            ->whereDate('start_date', '>', Carbon::now())
            ->get();

        // Combine the reminders into a single collection
        $reminders = collect();

        foreach ($conges as $conge) {
            $reminders->push([
                'type' => 'Congé',
                'start_date' => $conge->start_date,
            ]);
        }


        foreach ($missions as $mission) {
            $reminders->push([
                'type' => 'Mission',
                'start_date' => $mission->start_date,
            ]);
        }

        foreach ($appliedFormations as $appliedFormation) {
            $reminders->push([
                'type' => 'Formation',
                'start_date' => $appliedFormation->start_date,
            ]);
        }

        // Sort the reminders by start date in ascending order
        $sortedReminders = $reminders->sortBy('start_date');

        // Pass the reminders to the view
        return view('employeeDashboard', compact('sortedReminders'));
    }
}
