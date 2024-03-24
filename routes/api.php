<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
/*
Route::get('/hello', function () {
  return "Hello World!";
});
*/
Route::post('/users', 'App\Http\Controllers\UserController@store');
  Route::post('login', 'App\Http\Controllers\Auth\AuthenticatedSessionController@store');
  


 Route::middleware('auth')->group(function () {

    Route::post('/projects', 'App\Http\Controllers\ProjectController@store');
    Route::post('/timesheets', 'App\Http\Controllers\TimesheetController@store');
	Route::get('users/{id}', 'App\Http\Controllers\UserController@show');
	Route::get('projects/{id}', 'App\Http\Controllers\ProjectController@show');
	Route::get('timesheets/{id}', 'App\Http\Controllers\TimesheetController@show');
	Route::get('usersall', 'App\Http\Controllers\UserController@allUsers');
	Route::get('projectsall', 'App\Http\Controllers\ProjectController@allProjects');
	Route::get('timesheetsall', 'App\Http\Controllers\TimesheetController@allTimesheets');
	Route::post('userUpdate', 'App\Http\Controllers\UserController@update');
	Route::post('projectsUpdate', 'App\Http\Controllers\ProjectController@update');
	Route::post('timesheetsUpdate', 'App\Http\Controllers\TimesheetController@update');
	Route::post('userDelete', 'App\Http\Controllers\UserController@delete');
	Route::get('usersfilter', 'App\Http\Controllers\UserController@filterUsers');
});

