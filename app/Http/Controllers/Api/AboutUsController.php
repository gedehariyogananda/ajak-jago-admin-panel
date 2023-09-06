<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    public function index(){
        $user = User::with('team')->get();
        
        if($user){
            return response()->json([
                'success' => true,
                'message' => 'success',
                'user'    => $user,  
            ], 200); 
        } else {
            return response()->json([
                'success' => false,
                'message' => 'data ga ada',
            ], 409);
        } 

    }
}
