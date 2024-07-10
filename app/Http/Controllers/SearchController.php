<?php

namespace App\Http\Controllers;

use App\Models\Bootcamp;
use App\Models\Team;
use App\Models\User;
use App\Models\Webinar;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function searchTeam (Request $request){
        $query = $request->input('query');
        $users = User::get();
        $teams = Team::where('name', 'LIKE', '%' . $query. '%')->get();
        $tim = '';


        return view('content.paneluser.index', compact('users','teams','tim'));
    }



    public function searchUser (Request $request){
        $query = $request->input('query');
        $users = User::where('name', 'LIKE', '%' . $query. '%')->get();
        $teams = Team::get();
        $tim = '';


        return view('content.paneluser.index', compact('users','teams','tim'));
    }

    public function searchWebinar (Request $request){
        $query = $request->input('query');
        $webinars = Webinar::where('title', 'LIKE', '%' . $query. '%')->get();

        return view('content.webinar.index', compact('webinars'));
    }

    public function searchBootcamp (Request $request){
        $query = $request->input('query');
        $bootcamps = Bootcamp::where('title', 'LIKE', '%' . $query. '%')->get();

        return view('content.bootcamp.index', compact('bootcamps'));
    }

    public function searchUserToAddTeam (Request $request){
        $query = $request->input('query');
        $users = User::where('name', 'LIKE', '%' . $query. '%')->get();

        return view('content.addmember.shows', compact('users'));
    }
}
