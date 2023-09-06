<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Webinar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Contracts\Providers\JWT;
use Tymon\JWTAuth\Facades\JWTAuth;

class WebinarController extends Controller
{
    public function index()
    {
        $webinars = Webinar::latest()->get();

        if ($webinars) {
            return response()->json([
                'success' => true,
                'message' => 'success',
                'webinars' => $webinars,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'data tidak ditemukan',
            ], 409);
        }
    }

    public function pageShowWebinar(Webinar $webinar)
    {
        if ($webinar) {
            return response()->json([
                'success' => true,
                'message' => 'success',
                'webinar' => $webinar,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'data tidak ditemukan',
            ], 404);
        }
    }

    public function pageInsertWebinar(Request $request, Webinar $webinar)
    {
        // set auth user
        $tokenId = auth()->guard('api')->id();
        //set validasi
        $validator = Validator::make($request->all(), [
            'info' => ['required'],
            'bukti_follow' => ['required','mimes:jpg,bmp,png,pdf,docx', 'max:4000'],
            'bukti_share' => ['required', 'mimes:jpg,bmp,png,pdf,docx' , 'max:4000'],
            'next_idea' => ['required', 'string', 'min:3'],
        ]);

        //if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $partisipant = DB::table('partisipant_webinar')->insert([
            'info' => $request->info,
            'user_id' => $tokenId,
            'webinar_id' => $webinar->id,
            'bukti_follow' => $request->file('bukti_follow')->store('pict-webinars-users-image'),
            'bukti_share' => $request->file('bukti_share')->store('pict-webinars-users-image'),
            'next_idea' => $request->next_idea,
            'created_at' => now(),
        ]);

        //return response JSON user is created
        if ($partisipant) {
            return response()->json([
                'success' => true,
                'partisipant' => $partisipant,
            ], 201);
        }

        //return JSON process insert failed 
        return response()->json([
            'success' => false,
        ], 409);
    }

    public function isRegistered(Webinar $webinar)
    {
        $tokenId = auth()->guard('api')->id();
        // dd($token);
        $isRegistered = DB::table('partisipant_webinar')
            ->where('webinar_id', $webinar->id)
            ->where('user_id', $tokenId)
            ->get();

        //return response JSON user is created
        if ($isRegistered) {
            return response()->json([
                'success' => true,
                // 'partisipant' => $isRegistered,
            ], 201);
        }

        //return JSON process insert failed 
        return response()->json([
            'success' => false,
        ], 409);
    }
}
