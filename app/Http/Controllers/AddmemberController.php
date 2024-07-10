<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeamRequest;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AddmemberController extends Controller
{
    public function addMember(User $user){
        $teams = Team::all();
        return view('content.addmember.shows', compact('teams','user'));
    }

    public function editUser(Request $request, User $user){
        DB::table('users')
            ->where('id', $user->id)
            ->update([
                'team_id' => $request->team_id,
            ]);

            return redirect('/')->with('success', 'The user team has been updated successfully');
    }

    public function editTeam(Team $team){
        return view('content.addteam.edit', compact('team'));
    }

    public function editTeamed(TeamRequest $request, Team $team){
        $team->update($request->all());

        return redirect('/')->with('success', 'the name of team has been updated');

    }

    public function resetTeam(){
        DB::table('users')
        ->update(['team_id' => '2']);

        return redirect('/')->with('success', 'the name of team has been reset');
    }
}
