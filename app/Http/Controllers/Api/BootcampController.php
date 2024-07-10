<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bootcamp;
use App\Models\Team;
use App\Models\Webinar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{

    public function getJoinProgramPage()
    {
        $limitWebinar = DB::table('webinars')
            ->limit(3)
            ->latest()
            ->get();

        $limitBootcamp = DB::table('bootcamps')
            ->limit(3)
            ->latest()
            ->get();

        if ($limitWebinar && $limitBootcamp) {
            return response()->json([
                'success' => true,
                'message' => 'success',
                'limitWebinar' => $limitWebinar,
                'limitBootcamp' => $limitBootcamp,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'data tidak ditemukan',
            ], 409);
        }
    }

    public function getJagoDalamSehariPage()
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


    // insert jago dalam sehari
    public function insertJagoDalamSehari(Request $request, Webinar $webinar)
    {

        if (!$webinar) {
            return response()->json([
                'success' => false,
                'message' => 'webinar tidak ditemukan',
            ], 404);
        }

        // set auth user
        $tokenId = auth()->guard('api')->id();
        //set validasi
        $validator = Validator::make($request->all(), [
            'info' => ['required'],
            'bukti_follow' => ['required', 'mimes:jpg,bmp,png,pdf,docx'],
            'bukti_share' => ['required', 'mimes:jpg,bmp,png,pdf,docx'],
            'next_idea' => ['required', 'string', 'min:3'],
        ]);

        //if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if (DB::table('partisipant_webinar')->where('user-id', $tokenId) != null) {
            return response()->json([
                'message' => 'the user has been registered',
            ], 400);
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


    // insert jago chmap
    public function insertJagoChamp(Request $request)
    {
        $tokenId = auth()->guard('api')->id();
        //set validasi
        $validator = Validator::make($request->all(), [
            'jurusan' => ['required'],
            'bootcamp_id' => ['required'],
            'yangkamuketahui' => ['required'],
            'description' => ['required', 'min:3'],
            'pengembangan' => ['required', 'min:3'],
            'ekspetasi' => ['required', 'min:3'],
            'file_cv' => ['required', 'mimes:jpg,bmp,png,pdf,docx', 'max:3000'],
            'bukti_follows' => ['required', 'mimes:jpg,bmp,png,pdf,docx', 'max:3000'],
            'bukti_shared' => ['required', 'mimes:jpg,bmp,png,pdf,docx', 'max:3000'],
        ]);

        //if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $partisipant = DB::table('bootcamp_participant')->insert([
            'user_id' => $tokenId,
            'bootcamp_id' => $request->bootcamp_id,
            'yangkamuketahui' => $request->yangkamuketahui,
            'jurusan' => $request->jurusan,
            'description' => $request->description,
            'pengembangan' => $request->pengembangan,
            'ekspetasi' => $request->ekspetasi,
            'file_cv' => $request->file('file_cv')->store('pict-bootcamp-users-image'),
            'bukti_follows' => $request->file('bukti_follows')->store('pict-bootcamp-users-image'),
            'bukti_shared' => $request->file('bukti_shared')->store('pict-bootcamp-users-image'),
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


    public function getAboutUs()
    {
        $teams = Team::with('users')->where('id', '!=', 2)->where('id', '!=', 3)
            ->where('id', '!=', 4)
            ->where('id', '!=', 5)
            ->get();

        $result = [];
        $others = [];

        foreach ($teams as $team) {
            $teamMembers = [];

            foreach ($team->users as $user) {
                $teamMembers[] = [
                    'name' => $user->name,
                    'team' => $user->team->name,
                    'subteam' => $user->subteam,
                    'image' => $user->profile_picture,
                ];
            }

            // Check if the team name is "C-LEVEL"
            if ($team->name === 'C-LEVEL') {
                $result['C-LEVEL'] = $teamMembers;
            } else {
                $others[$team->name] = $teamMembers;
            }
        }

        if ($result) {
            $response = [
                'success' => true,
                'result' => [
                    'C-LEVEL' => $result['C-LEVEL'],
                    'Others' => $others,
                ],
            ];
            return response()->json($response, 201);
        }

        return response()->json([
            'success' => false,
        ], 409);
    }


    public function isRegisteredWebinar(Webinar $webinar)
    {

        if (!$webinar) {
            return response()->json([
                'success' => false,
                'message' => 'webinar tidak ditemukan',
            ], 404);
        }

        $tokenId = auth()->guard('api')->id();

        $checked = DB::table('partisipant_webinar')
            ->where('user_id', $tokenId)
            ->where('webinar_id', $webinar->id)
            ->first();

        if ($checked) {
            return response()->json([
                'success' => true,
                'message' => 'is registered',
            ], 201);
        }

        return response()->json([
            'success' => false,
            'message' => 'not registered',
        ], 201);
    }


    public function isRegisteredBootcamp()
    {

        $bootcamps = DB::table('bootcamps')->limit(3)->get();

        if (!$bootcamps) {
            return response()->json([
                'success' => false,
                'message' => 'data tidak ditemukan',
            ], 404);
        }

        $tokenId = auth()->guard('api')->id();
        $isRegistered = false;

        foreach ($bootcamps as $bootcamp) {
            $checked = DB::table('bootcamp_participant')
                ->where('user_id', $tokenId)
                ->where('bootcamp_id', $bootcamp->id)
                ->first();

            if ($checked) {
                $isRegistered = true;
                break; // Keluar dari loop jika pengguna terdaftar dalam salah satu bootcamp
            }
        }

        if ($isRegistered) {
            return response()->json(['success' => true, 'message' => 'is registered',], 201);
        }

        return response()->json(['success' => false, 'message' => 'not registered',], 201);
    }

    public function editProfile()
    {
        $tokenId = auth()->guard('api')->id();

        try {
            $user = DB::table('users')
                ->where('id', $tokenId)
                ->first();

            if ($user) {
                return response()->json([
                    'success' => true,
                    'user' => $user,
                ], 201);
            }

            return response()->json([
                'success' => false,
            ], 409);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 409);
        }
    }

    public function editProfileAction(Request $request)
    {
        $tokenId = auth()->guard('api')->id();

        $validate = Validator::make($request->all(), [
            'name' => ['string', 'min:3'],
            'provincial_origin' => ['string', 'min:3'],
            'wa_number' => ['string', 'min:3'],
            'institusi' => ['string', 'min:3'],
            'age' => ['string', 'min:3'],
        ]);

        if ($validate->fails()) {
            return response()->json($validate->errors(), 422);
        }

        $user = DB::table('users')
            ->where('id', $tokenId)
            ->update([
                'name' => $request->name,
                'provincial_origin' => $request->provincial_origin,
                'wa_number' => $request->wa_number,
                'institusi' => $request->institusi,
                'age' => $request->age,
                'updated_at' => now(),
            ]);

        if ($user) {
            return response()->json([
                'success' => true,
                'user' => $user,
            ], 201);
        }

        return response()->json([
            'success' => false,
        ], 409);
    }

    public function editEmail(Request $request)
    {
        $tokenId = auth()->guard('api')->id();

        $validate = Validator::make($request->all(), [
            'email' => ['required', 'email', 'unique:users'],
        ]);

        if ($validate->fails()) {
            return response()->json($validate->errors(), 422);
        }

        $user = DB::table('users')
            ->where('id', $tokenId)
            ->update([
                'email' => $request->email,
                'updated_at' => now(),
            ]);

        if ($user) {
            return response()->json([
                'success' => true,
                'user' => $user,
            ], 201);
        }

        return response()->json([
            'success' => false,
        ], 409);
    }

    public function editPassword(Request $request)
    {
        $tokenId = auth()->guard('api')->id();

        $validate = Validator::make($request->all(), [
            'password' => ['required', 'min:8'],
        ]);

        if ($validate->fails()) {
            return response()->json($validate->errors(), 422);
        }

        $user = DB::table('users')
            ->where('id', $tokenId)
            ->update([
                'password' => bcrypt($request->password),
                'updated_at' => now(),
            ]);

        if ($user) {
            return response()->json([
                'success' => true,
                'user' => $user,
            ], 201);
        }

        return response()->json([
            'success' => false,
        ], 409);
    }
}
