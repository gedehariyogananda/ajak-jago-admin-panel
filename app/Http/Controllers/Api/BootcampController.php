<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bootcamp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BootcampController extends Controller
{
    public function index(){
        $bootcamps = DB::table('bootcamps')
                    ->limit(3)
                    ->latest()
                    ->get();

        if($bootcamps){
            return response()->json([
                'status' => true,
                'message' => 'sukses ditemukan',
                'bootcamps' => $bootcamps,
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'data tidak ditemukan',
            ], 409);
        }
    }


    public function pageShowBootcamp(){

        $bootcamps = DB::table('bootcamps')
                        ->limit(3)
                        ->latest()
                        ->get();

        if($bootcamps){
            return response()->json([
                'status' => true,
                'message' => 'sukses ditemukan',
                'bootcamps' => $bootcamps,
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'data tidak ditemukan',
            ], 409);
        }
    }

    public function pageInsertBootcamp(Request $request, Bootcamp $bootcamp){
        
        // set user
        $tokenId = auth()->guard('api')->id();
        //set validasi
             $validator = Validator::make($request->all(), [
                'jurusan' => ['required'],
                'description' => ['required','min:3'],
                'pengembangan' => ['required','min:3'],
                'ekspetasi' => ['required','min:3'],
                'file_cv' => ['required','mimes:jpg,bmp,png,pdf,docx', 'max:3000'],
                'bukti_follows' => ['required','mimes:jpg,bmp,png,pdf,docx','max:3000'],
                'open_regis' => ['required','mimes:jpg,bmp,png,pdf,docx','max:3000'],
            ]);
    
            //if validation fails
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
    
            $partisipant = DB::table('bootcamp_participant')->insert([
                'user_id' => $tokenId,
                'bootcamp_id' => $bootcamp->id,
                'jurusan' => $request->jurusan,
                'description' => $request->description,
                'pengembangan' => $request->pengembangan,
                'ekspetasi' => $request->ekspetasi,
                'file_cv' => $request->file('file_cv')->store('pict-bootcamp-users-image'),
                'bukti_follows' => $request->file('bukti_follows')->store('pict-bootcamp-users-image'),
                'open_regis' => $request->file('open_regis')->store('pict-bootcamp-users-image'),
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
    
}
