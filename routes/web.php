<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FormationsController;
use App\Http\Controllers\CongeController;
use App\Http\Controllers\EmployeeDashboardController;
use App\Models\AppliedFormation;
use Illuminate\Http\Request;
use App\Http\Controllers\ReminderController;
use App\Http\Controllers\RhMemberController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::get('/aboutMe', function () {
    return view('aboutMe');
});

Route::get('/rhLogin', function () {
    return view('rhLogin');
});

// Route::get('/rhDashboard', function () {
//     return view('rhDashboard');
// });
Route::get('/rhDashboard', [RhMemberController::class, 'rhDashboard'])->name('rhDashboard');

Route::get('/login', function () {
    return view('login');
});

Route::post('/register', 'App\Http\Controllers\AuthController@register')->name('register');

Route::post('/login', 'App\Http\Controllers\AuthController@login')->name('login');

Route::get('/logout', 'App\Http\Controllers\AuthController@logout')->name('logout');

Route::get('/employeeDashboard', function () {
    return view('employeeDashboard');
});



Route::post('/insert-conge', 'App\Http\Controllers\CongeController@insert')->name('insert-conge');





Route::get('/employeeDashboard', [EmployeeDashboardController::class, 'index'])->name('employeeDashboard');

Route::post('/insert-mission', 'App\Http\Controllers\MissionController@insert')->name('insert-mission');

// Route::post('/apply-for-formation', function (Request $request) {
//     $formationId = $request->input('formation_id');
//     $employeeId = session('id_employee');

//     // Insert the data into the "applied_formations" table
//     AppliedFormation::create([
//         'id_formation' => $formationId,
//         'id_employee' => $employeeId,
//     ]);

//     return redirect('/employeeDashboard')->with('success', 'Successfully applied for the formation.');
// })->name('apply-for-formation');

Route::post('/apply-for-formation', [EmployeeDashboardController::class, 'applyForFormation'])->name('apply-for-formation');

Route::get('/reminders', [ReminderController::class, 'index'])->name('reminders.index');

// Route::get('/employeeDashboard', [ReminderController::class, 'index'])->name('employeeDashboard');

// RH

Route::post('/rh-login', 'App\Http\Controllers\RhMemberController@login')->name('rh-login');

Route::get('/formations/create', 'App\Http\Controllers\FormationsController@create')->name('formations.create');
Route::post('/formations', 'App\Http\Controllers\FormationsController@store')->name('formations.store');



Route::get('/formation/{id}/update', 'App\Http\Controllers\FormationsController@updateForm')->name('update-formation');
Route::put('/formation/{id}', 'App\Http\Controllers\FormationsController@update')->name('save-formation');
Route::delete('/formation/{id}', 'App\Http\Controllers\FormationsController@destroy')->name('delete-formation');

// Route::put('/update-conge-status/{id}', 'App\Http\Controllers\CongeController@updateCongeStatus')
//     ->name('update-conge-status');

Route::put('/conge/{id}/update-status', 'App\Http\Controllers\CongeController@updateCongeStatus')->name('update-conge-status');


