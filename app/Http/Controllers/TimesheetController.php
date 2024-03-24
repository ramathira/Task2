<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Timesheet;
class TimesheetController extends Controller
{
     public function store(Request $request)
    {
		   	$messages = [
    'task_name.required' => 'The task name is required.',
    'task_date.required' => 'The task date is required.',
    'hours.required' => 'Time duration is required.',
    'user_id.required' => 'User is required',
    'project_id.required' => 'The project is required.'
    
];
	 $validatedData=	 $request->validate([
        'task_name' => 'required|string|max:255',
         'task_date' => 'required|date|date_format:Y-m-d',
         'hours' => 'required|numeric|min:1|max:3',
         'user_id' => 'required|numeric',
         'project_id' => 'required|numeric',
       

    ], $messages);
	

	 $timesheet = Timesheet::create($validatedData);
        return response()->json($timesheet, 201);
		
	}
	
	
	 public function show($id)
    {
        // Retrieve the record from the database
        $record = Timesheet::find($id);

        // Check if the record exists
        if (!$record) {
            return response()->json(['message' => 'Record not found'], 404);
        }

        // Return the record as a JSON response
        return response()->json($record);
    }
	
	public function allTimesheets()
    {
         // Retrieve all records from the Timesheet model
        $timesheets = Timesheet::all();

        // Return the records as a JSON response
        return response()->json($timesheets);
    }
	
	public function update(Request $request, $timesheetid)
    {
        // Retrieve the record from the database
        $timesheet = Project::find($timesheetid);

        // Check if the record exists
        if (!$timesheet) {
            return response()->json(['message' => 'Not found'], 404);
        }

        // Validate request data
        $validatedData = $request->validate([
            'task_name' => 'required|string|max:255',
         'task_date' => 'required|date|date_format:Y-m-d',
         'hours' => 'required|numeric|min:1|max:3',
         'user_id' => 'required|numeric',
         'project_id' => 'required|numeric',
        ]);

        // Update the record with the provided data
        $timesheet->update($validatedData);

        // Return a success response
        return response()->json(['message' => 'Timesheet updated successfully']);
    }
	
	
	
}
