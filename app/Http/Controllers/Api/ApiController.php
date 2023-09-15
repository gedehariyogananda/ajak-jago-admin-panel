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

    public function getJoinProgramPage(){
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
    public function insertJagoDalamSehari(Request $request, Webinar $webinar){
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


      // insert jago chmap
      public function insertJagoChamp(Request $request){
        $tokenId = auth()->guard('api')->id();
        //set validasi
             $validator = Validator::make($request->all(), [
                'jurusan' => ['required'],
                'bootcamp_id' => ['required'],  
                'description' => ['required','min:3'],
                'pengembangan' => ['required','min:3'],
                'ekspetasi' => ['required','min:3'],
                'file_cv' => ['required','mimes:jpg,bmp,png,pdf,docx', 'max:3000'],
                'bukti_follows' => ['required','mimes:jpg,bmp,png,pdf,docx','max:3000'],
                'bukti_shared' => ['required','mimes:jpg,bmp,png,pdf,docx','max:3000'],
            ]);
    
            //if validation fails
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
    
            $partisipant = DB::table('bootcamp_participant')->insert([
                'user_id' => $tokenId,
                'bootcamp_id' => $request->bootcamp_id,
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

        
        public function getAboutUs(){

            $teams = Team::with('users')->where('id', '!=', 2)->where('id', '!=', 3)->get();

            $result = [];
        
            foreach ($teams as $team) {
                $teamMembers = [];
        
                foreach ($team->users as $user) {
                    $teamMembers[] = [
                        'name' => $user->name,
                        'team' => $user->team->name,
                        'subteam' => $user->subteam,
                    ];
                }
        
                $result[$team->name] = $teamMembers;
            }

            if ($result) {
                return response()->json([
                    'success' => true,
                    'result' => $result,
                ], 201);
            }
    
            return response()->json([
                'success' => false,
            ], 409);
            
        }


        public function isRegisteredWebinar(Webinar $webinar){

            $tokenId = auth()->guard('api')->id();

            $checked = DB::table('partisipant_webinar')
                        ->where('user_id', $tokenId)
                        ->where('webinar_id', $webinar->id)
                        ->first();

            if ($checked) {
                return response()->json([
                    'success' => true, 
                ], 201);
            }
    
            return response()->json([
                'success' => false,
            ], 409);
        }   

        public function isRegisteredBootcamp(){
            
            $bootcamp = DB::table('bootcamps')->limit(3)->get();

            $tokenId = auth()->guard('api')->id();

            $checked = DB::table('bootcamp_participant')
                        ->where('user_id', $tokenId)
                        ->where('bootcamp_id', $bootcamp[0]->id)
                        ->orWhere('bootcamp_id', $bootcamp[1]->id)
                        ->orWhere('bootcamp_id', $bootcamp[2]->id)
                        ->first();
            
         if ($checked) {
            return response()->json([
                'success' => true, 
            ], 201);
            }
    
            return response()->json([
                'success' => false,
            ], 409);
        }

    }
