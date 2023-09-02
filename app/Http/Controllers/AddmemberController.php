<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeamRequest;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AddmemberController extends Controller
{
    public function addMember(Team $team){
        $users = User::all();
        return view('content.addmember.shows', compact('team','users'));
    }

    public function editUser(Request $request, Team $team){
        DB::table('users')
            ->where('id', $request->user_id)
            ->update([
                'team_id' => $team->id,
            ]);

            return redirect('admin/panel-user')->with('success', 'The user team has been updated');
    }

    public function editTeam(Team $team){
        return view('content.addteam.edit', compact('team'));
    }

    public function editTeamed(TeamRequest $request, Team $team){
        $team->update($request->all());

        return redirect('admin/panel-user')->with('success', 'The name of team has been updated');

    }
}
