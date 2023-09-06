<?php

namespace App\Http\Controllers;

use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\TeamRequest;
use App\Models\Team;
use Illuminate\Support\Str;

class TeamController extends Controller
{
    public function showTeam(Team $team)
    {
        $users = $team->users;
        $teams = Team::all();
        $tim = Team::where('id', $team->id)->pluck('name')->first();

        return view('content.paneluser.index', compact('teams', 'users', 'tim'));
    }

    public function show()
    {

        return view('content.addteam.show');
    }

    public function store(TeamRequest $request)
    {
        Team::create([
            'name' => $request->name,
            'identifier' => Str::slug($request->name),
        ]);

        return redirect('/')->with('success', 'You are succes make team');
    }

    public function destroy(Team $team){
        
        $team->delete();

        return back()->with('success', 'You are succes delete team');
    }
}
