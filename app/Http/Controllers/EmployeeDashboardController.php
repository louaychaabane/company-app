<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Formation;
use App\Models\Conge;
use App\Models\Mission;
use App\Models\User;
use App\Models\AppliedFormation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class EmployeeDashboardController extends Controller
{
    //
    public function index()
    {
        $conges = Conge::all();
        $formations = Formation::all();
        $missions = Mission::all();

        $employeeId = session('id_employee');
        $now = Carbon::now();

        // Get upcoming conges, formations, missions, and applied formations
        $upcomingConges = Conge::where('id_employee', $employeeId)
        ->whereDate('start_date', '>', $now)
        ->get();

        $upcomingMissions = Mission::where('id_employee', $employeeId)
        ->whereDate('start_date', '>', $now)
        ->get();

        $upcomingAppliedFormations = AppliedFormation::where('id_employee', $employeeId)
            ->whereDate('start_date', '>', $now)->get();

        // Combine the reminders into a single collection
        $sortedReminders = collect();

        foreach ($upcomingConges as $conge) {
            if ($conge->status === 'accepted') {
                $sortedReminders->push([
                    'type' => 'Congé',
                    'start_date' => $conge->start_date,
                ]);
            }
        }

        foreach ($upcomingMissions as $mission) {
            $sortedReminders->push([
                'type' => 'Mission',
                'start_date' => $mission->start_date,
            ]);
        }

        foreach ($upcomingAppliedFormations as $appliedFormation) {
            $sortedReminders->push([
                'type' => 'Formation',
                'start_date' => $appliedFormation->start_date,
            ]);
        }

        // Sort the reminders by start date in ascending order
        $sortedReminders = $sortedReminders->sortBy('start_date');

        $user = User::where('id_employee', $employeeId)->first();

        // Combine the data into a single array or collection
        $data = [
            'conges' => $conges,
            'formations' => $formations,
            'missions' => $missions,
            'sortedReminders' => $sortedReminders,
            'user' => $user,
        ];

        return view('employeeDashboard', $data);
    }

    public function applyForFormation(Request $request)
    {
        $formationId = $request->input('formation_id');
        $employeeId = session('id_employee');

        // Check if the employee has already applied for this formation
        $appliedFormation = AppliedFormation::where('id_employee', $employeeId)
            ->where('id_formation', $formationId)
            ->first();

        if (!$appliedFormation) {
            $formation = Formation::find($formationId);

            // Insert the record into the applied_formations table
            AppliedFormation::create([
                'id_employee' => $employeeId,
                'id_formation' => $formationId,
                'start_date' => $formation->start_date,
            ]);
        }

        // Redirect back to the employee dashboard
        return redirect()->route('employeeDashboard');
    }
}
