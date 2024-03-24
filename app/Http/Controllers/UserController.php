<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Timesheet;
use Illuminate\Support\Facades\Hash;
Use DB;

class UserController extends Controller
{
    public function store(Request $request)
    {
       
	   	$messages = [
    'f_name.required' => 'The first name field is required.',
    'l_name.required' => 'The last name field is required.',
    'dob.required' => 'DoB is required.',
    'gender.required' => 'gender is required.',
    'email.required' => 'The email field is required.',
    'password.required' => 'The password field is required.',

];
	 $validatedData=	 $request->validate([
        'f_name' => 'required|string|max:255',
        'l_name' => 'required|string|max:255',
         'dob' => 'required|date|date_format:Y-m-d',
         'gender' => 'required|numeric|min:1|max:3',
        'email' => 'required|email|unique:users|max:255',
        'password' => 'required|string|min:8',

    ], $messages);
	
 $user = User::create([
            'f_name' => $request->f_name,
            'l_name' => $request->l_name,
            'dob' => $request->dob,
            'gender' => $request->gender,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json($user, 201);

    }
	
	
	 public function show( $id)
    {
        // Retrieve the record from the database
        $record = User::find($id);

        // Check if the record exists
        if (!$record) {
            return response()->json(['message' => 'Record not found'], 404);
        }

        // Return the record as a JSON response
        return response()->json($record);
    }
	
	 public function allUsers()
    {
         // Retrieve all records from the User model
        $users = User::all();

        // Return the records as a JSON response
        return response()->json($users);
    }
	
	 public function update(Request $request, $user)
    {
        // Retrieve the record from the database
        $user = User::find($user);

        // Check if the record exists
        if (!$user) {
            return response()->json(['message' => 'Record not found'], 404);
        }

        // Validate request data
        $validatedData = $request->validate([

            'f_name' => 'required|string|max:255',
            'l_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,

        ]);

        // Update the record with the provided data
        $user->update($validatedData);

        // Return a success response
        return response()->json(['message' => 'Record updated successfully']);
    }
	
	public function delete(Request $request)
    {
		
        // Retrieve the user record from the database
        $user = User::find($request->id);

        // Check if the user exists
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Delete related timesheets
        $user->timesheets()->delete();

        // Delete the user record
        $user->delete();

        // Return a success response
        return response()->json(['message' => 'User and related timesheets deleted successfully']);
    }
	
	public function filterUsers(Request $request)
    {
        // Start with all records
        $query = User::query();

        // Apply filters if provided in the request
        if ($request->has('f_name')) {
            $query->where('f_name', $request->input('f_name'));
        }
         if ($request->has('dob')) {
            $query->where('dob', $request->input('dob'));
        }
        if ($request->has('gender')) {
            $query->where('gender', $request->input('gender'));
        }
               // Retrieve filtered records
			  
        $users = $query->get();
	
	//DB::enableQueryLog();
	//dd(DB::getQueryLog());
		

        // Return the filtered records as a response
        return response()->json($users);
    }
}
