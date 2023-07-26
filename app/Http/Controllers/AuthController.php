<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'id_employee' => 'required|string|max:255|unique:users',
            'cin' => ['required', 'string', 'max:8', 'regex:/^[01]\d{7}$/', 'unique:users'],
            'phone' => ['required', 'string', 'regex:/^\d{8}$/'],
            'date_of_birth' => 'nullable|date',
            'specialite' => 'required|string',
            'password' => 'required|string|min:8',
        ]);

        // Create a new User instance
        $user = new User();
        // Set the user's attributes
        $user->name = $request->input('name');
        $user->id_employee = $request->input('id_employee');
        $user->cin = $request->input('cin');
        $user->phone = $request->input('phone');
        $user->date_of_birth = $request->input('date_of_birth');
        $user->specialite = $request->input('specialite');
        $user->password = bcrypt($request->input('password'));

        // Save the user in the database
        $user->save();

        // Redirect the user to a success page or perform any other actions

        // For example, redirect to the home page
        return redirect('/login')->with('success', 'User created successfully');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('id_employee', 'cin', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            session([
                'name' => $user->name,
                'id_employee' => $user->id_employee,
                'cin' => $user->cin,
                'phone' => $user->phone,
                'date_of_birth' => $user->date_of_birth,
                'specialite' => $user->specialite,
                'credits' => $user->credits,
            ]);
            // Authentication passed, redirect to the dashboard or any other protected page
            return redirect('/employeeDashboard')->with('success', 'Logged in successfully');
        } else {
            // Authentication failed, redirect back to the login page with an error message
            throw ValidationException::withMessages([
                'login_error' => 'Invalid login inputs',
            ])->redirectTo(route('login'));
        }
    }
    public function logout()
    {
        Auth::logout();
        session()->flush();
        return redirect('/')->with('success', 'Logged out successfully');
    }
}
