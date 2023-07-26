<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RhMember;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User;
use App\Models\Formation;
use App\Models\Conge;
use App\Models\Mission;
use App\Models\AppliedFormation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class RhMemberController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // Attempt to authenticate the RhMember using the provided credentials
        if (Auth::guard('rh_members')->attempt($credentials)) {
            session(['rhloggedIn' => true]);
            // Authentication successful, redirect to the rhDashboard
            return redirect()->route('rhDashboard');
        } else {
            // Authentication failed, redirect back to the login page with an error message
            return redirect()->back()->withErrors(['email' => 'Invalid credentials']);
        }
    }

    public function rhDashboard()
    {
        $conges = Conge::all();
        $formations = Formation::all();
        $missions = Mission::all();

        $now = Carbon::now();


        // Combine the reminders into a single collection

        // Combine the data into a single array or collection
        $data = [
            'conges' => $conges,
            'formations' => $formations,
            'missions' => $missions,
        ];

        return view('rhDashboard', $data);
    }

}
