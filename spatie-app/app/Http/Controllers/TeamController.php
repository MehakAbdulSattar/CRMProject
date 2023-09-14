<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Team;
use App\Models\Permission;
use Illuminate\Support\Facades\Validator;





class TeamController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }


    // index: Get a list of all teams.
    public function index()
    {
        $teams = Team::all();
        return response()->json(['data' => $teams]);
    }

    // store: Create a new team.

    // public function store(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'name' => 'required|string|max:255',
    //         'department_id' => 'required|exists:departments,id',
    //         'TeamLead_ID' => 'required|exists:users,id',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json(['error' => $validator->errors()], 400);
    //     }

    //     $team = Team::create($request->all());

    //     return response()->json(['message' => 'Team created successfully', 'data' => $team], 201);
    // }


    public function store(Request $request)
    {
        $team = Team::create([
            'name' => $request->input('name'),
            'department_id' => $request->input('department_id'),
            'teamlead_id' => $request->input('teamlead_id'),
        ]);
        //$permissions = Permission::where('user_id',auth()->user()->id)->get();
        if (Auth()->user()->hasPermission('create_team',$team)) {
            // User has permission to update the team
            // Your update logic here...
            return $team;
        } else {
            // User does not have permission
            return response()->json(['message' => 'Permission denied'], 403);
        }
    
        

        //return response()->json(['message' => 'Team created successfully', 'data' => $team], 201);
    }


    // show: Get a specific team by ID.

    public function show($id)
    {
        // return $Team=Team::all();
        $team = Team::find($id);


        if (!$team) {
            return response()->json(['error' => 'Team not found'], 404);
        }

        return response()->json(['data' => $team]);
    }

    // update: Update a team's information.

    // public function update(Request $request, $id)
    // {
    //     $team = Team::find($id);

    //     if (!$team) {
    //         return response()->json(['error' => 'Team not found'], 404);
    //     }

    //     $validator = Validator::make($request->all(), [
    //         'name' => 'required|string|max:255',
    //         'Department_ID' => 'required|exists:departments,id',
    //         'TeamLead_ID' => 'required|exists:users,id',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json(['error' => $validator->errors()], 400);
    //     }

    //     $team->update($request->all());

    //     return response()->json(['message' => 'Team updated successfully', 'data' => $team]);
    // }

    public function update(Request $request)
    {
        $team = Team::find($request->id);

        if (!$team) {
            return response()->json(['error' => 'Team not found'], 404);
        }
        
        $team->update([
                'name' => $request->name,
                'department_id' => $request->department_id,
                'teamlead_id' => $request->teamlead_id,
        ]);
        return response()->json(['message' => 'Team updated successfully', 'data' => $team]);

    }


    // destroy: Delete a team.

    public function destroy($id)
    {
        $team = Team::find($id);

        if (!$team) {
            return response()->json(['error' => 'Team not found'], 404);
        }

        $team->delete();

        return response()->json(['message' => 'Team deleted successfully']);
    }
}