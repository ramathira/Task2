<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
class ProjectController extends Controller
{
    public function store(Request $request)
    {
		   	$messages = [
    'name.required' => 'The project name is required.',
    'department.required' => 'The department name is required.',
    'start_date.required' => 'Project start date is required.',
    'end_date.required' => 'Project end date is required.',
    'status.required' => 'The status is required.'
    
];
	 $validatedData=	 $request->validate([
        'name' => 'required|string|max:255',
        'department' => 'required|string|max:255',
         'start_date' => 'required|date|date_format:Y-m-d',
         'end_date' => 'required|date|date_format:Y-m-d|after_or_equal:start_date',
         'status' => 'required|numeric|min:1|max:3',
       

    ], $messages);
	

	 $project = Project::create($validatedData);
        return response()->json($project, 201);
		
	}
	
	 public function show( $id)
    {
        // Retrieve the record from the database
        $record = Project::find($id);

        // Check if the record exists
        if (!$record) {
            return response()->json(['message' => 'Record not found'], 404);
        }

        // Return the record as a JSON response
        return response()->json($record);
    }
	
	public function allProjects()
    {
         // Retrieve all records from the Project model
        $projects = Project::all();

        // Return the records as a JSON response
        return response()->json($projects);
    }
	
	public function update(Request $request, $projectId)
    {
        // Retrieve the record from the database
        $project = Project::find($projectId);

        // Check if the record exists
        if (!$project) {
            return response()->json(['message' => 'Project not found'], 404);
        }

        // Validate request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|string|in:ongoing,completed,pending',
        ]);

        // Update the record with the provided data
        $project->update($validatedData);

        // Return a success response
        return response()->json(['message' => 'Project updated successfully']);
    }
}
