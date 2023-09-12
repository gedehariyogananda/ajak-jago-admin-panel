<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Team;
use App\Models\User;

class HomeController extends Controller
{

    public function index()
    {
        $teams = Team::all();
        $users = User::all();
        $tim = 'Over All';
        return view('content.paneluser.index', compact('users','teams','tim'));
    }

    public function edit(User $user){
        $teams = Team::all();
        return view('content.paneluser.edit', compact('user', 'teams'));
    }

    public function editTeam(User $user){
        return view('content.paneluser.editteam', compact('user'));
    }

    public function editTeamNoClevel(User $user){
        return view('content.paneluser.editteamnoclevel', compact('user'));
    }

    public function editTeamNoCleveled(UserRequest $request, User $user){

        if($request->profile_picture == null){  
            $user->update([
                'subteam' => $request->subteam,
            ]);
        } 
        else {
            if($request->subteam == null){
                $user->update([
                    'profile_picture' => $request->file('profile_picture')->store('pict-profile-subteam'),
                ]);
            } else {
                if($request->subteam == null){
                    $user->update([
                        'profile_picture' => $request->file('profile_picture')->store('pict-profile-subteam'),
                    ]);
                } else {
                    if($request->subteam == 'Associate'){
                        return back()->with('success', 'Sorry, The sub team of C-LEVEL Associate not enought to insert picture');
                    } else {
                        $user->update([
                            'profile_picture' => $request->file('profile_picture')->store('pict-profile-subteam'),
                            'subteam' => $request->subteam,
                        ]);
                    }
                    
                }
            }
           
        }

        return redirect('/')->with('success', 'the user sub team has been updated');
    }   


    public function editTeamed(UserRequest $request, User $user){
        
        if($request->profile_picture == null){  
            $user->update([
                'subteam' => $request->subteam,
            ]);
        } 
        else {
            if($request->subteam == null){
                $user->update([
                    'profile_picture' => $request->file('profile_picture')->store('pict-profile-subteam'),
                ]);
            } else {
                $user->update([
                    'profile_picture' => $request->file('profile_picture')->store('pict-profile-subteam'),
                    'subteam' => $request->subteam,
                ]);
            }
           
        }

        return redirect('/')->with('success', 'the user sub team has been updated');
    }

    public function update(UserRequest $request, User $user){

        $user->update([
            'team_id' => $request->team_id,
            'subteam' => '-',
        ]);

        return redirect('/')->with('success', 'team has been updated successfully');
    }

    public function destroy(User $user){
        $user->delete();

        return back()->with('success', 'Team has been deleted successfully');
    }
}
