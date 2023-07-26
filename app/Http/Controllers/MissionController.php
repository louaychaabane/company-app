<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Conge;
use App\Models\Mission;
use Carbon\Carbon;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class MissionController extends Controller
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

        $mission = new Mission();

        $mission->start_date = $request->input('start_date');
        $mission->end_date = $request->input('end_date');
        $mission->id_employee = session('id_employee');
        $mission-> description= $request->input('description');

        $mission->save();

        return redirect('/employeeDashboard')->with('success', 'mission inserted successfully');
}
}