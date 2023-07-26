<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Conge;
use App\Models\User;
use App\Models\RhMember;
use Carbon\Carbon;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;


class CongeController extends Controller
{
    public function insert(Request $request)
    {

        $request->validate([
            'start_date' => [
                'required',
                'date',
                function ($attribute, $value, $fail) use ($request) {
                    $startDate = Carbon::parse($value);
                    $endDate = Carbon::parse($request->input('end_date'));

                    $existingConges = Conge::where('id_employee', session('id_employee'))
                        ->where(function ($query) use ($startDate, $endDate) {
                            $query->whereDate('start_date', '<=', $endDate)
                                ->whereDate('end_date', '>=', $startDate);
                        })
                        ->get();

                    if ($existingConges->isNotEmpty()) {
                        $fail('The selected vacation period overlaps with an existing congé.');
                    }
                },
            ],
            'end_date' => 'required|date|after_or_equal:start_date',
            'description' => 'required'
        ]);

        $conge = new Conge();

        $conge->start_date = $request->input('start_date');
        $conge->end_date = $request->input('end_date');
        $conge->id_employee = session('id_employee');
        $conge->description = $request->input('description');

        $conge->save();


        // Redirect the user to a success page or perform any other actions
        return redirect('/employeeDashboard')->with('success', 'Conge inserted successfully');
        // } else {
        //     // Handle the case where the user does not exist or is null
        //     return redirect('/employeeDashboard')->with('error', 'User not found');
        // }
    }

    public function updateCongeStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:accepted,denied',
            'employee_id' => 'required',
        ]);

        $conge = Conge::findOrFail($id);
        $conge->status = $request->input('status');
        $conge->save();

        $employeeId = $request->input('employee_id');
        $user = User::where('id_employee', $employeeId)->firstOrFail();



        // Retrieve all conge entries for the current id_employee
        $allConge = Conge::where('id_employee', $employeeId)
            ->where('status', 'accepted')
            ->get();


        // Calculate the total number of days
        $totalDays = 0;
        foreach ($allConge as $congeEntry) {
            $start_date = Carbon::parse($congeEntry->start_date);
            $end_date = Carbon::parse($congeEntry->end_date);
            $days = 1 +  $end_date->diffInDays($start_date);
            $totalDays += $days;
        }

        // Subtract the total days from the credits column in the users table

        $newCredits = 30 - $totalDays;
        $user->credits = $newCredits;
        $user->save();

        // Session::put('credits', $newCredits);

        return redirect()->route('rhDashboard')->with('success', 'Conge status updated successfully');
    }
}
