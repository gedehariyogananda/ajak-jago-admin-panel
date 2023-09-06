<?php

namespace App\Http\Controllers;

use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\WebinarRequest;
use App\Models\Webinar;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class WebinarController extends Controller
{
    public function index(){
        $webinars = Webinar::simplePaginate(3);
        return view('content.webinar.index', compact('webinars'));
    }

    public function edit(Webinar $webinar){
        $webinars = $webinar->status;
        return view('content.webinar.edit', compact('webinar', 'webinars'));
    }

    public function update(WebinarRequest $request, Webinar $webinar){
        if($request->image_path == null){  
            $webinar->update($request->all());
        }  else {
                $webinar->update([
                    'title' => $request->title,
                    'description' => $request->description,
                    'identifier' => Str::slug($request->title) . Str::random(10),
                    'datetime' => $request->datetime,
                    'status' => $request->status,
                    'place' => $request->place,
                    'fee' => $request->fee,
                    'video_url' => $request->video_url,
                    'meet_url' => $request->meet_url,
                    'poster_url' => $request->poster_url,
                    'image_path' => $request->file('image_path')->store('pict-webinars-images'),
                ]);
        }

        return redirect('admin/panel-jago-dalam-sehari')->with('success','the webinars data has been updated successfully');

    }

    public function show(){
        return view('content.webinar.show');
    }

    public function store(WebinarRequest $request){
        Webinar::create([
            'title' => $request->title,
            'identifier' => Str::slug($request->title) . Str::random(10),
            'description' => $request->description,
            'datetime' => $request->datetime,
            'place' => $request->place,
            'fee' => $request->fee,
            'status' => 'open',
            'video_url' => $request->video_url,
            'meet_url' => $request->meet_url,
            'poster_url' => $request->poster_url,
            'image_path' => $request->file('image_path')->store('pict-webinars-images'),
        ]);

        return redirect('admin/panel-jago-dalam-sehari')->with('success', 'The Webinar Has Successfully Added');
    }

    public function destroy(Webinar $webinar){
        $webinar->delete();

        return back()->with('success', 'The Webinar Has been delete');
    }

    public function responded(Webinar $webinar) {

        // $detailUser = User::with('webinars');
        return view('content.webinar.responded', compact('webinar'));
    }

    // downloader bukti_folows
    public function downloader($parameter1 , $parameter2){

        $getData = DB::table('partisipant_webinar')
                ->where('user_id', $parameter2)
                ->where('webinar_id', $parameter1 )
                ->select('bukti_follow')
                ->first();

        return Storage::download($getData->bukti_follow);
    }
       

    // bukti shared
    public function downloaderBukti($parameter1,$parameter2){
        $getData = DB::table('partisipant_webinar')
                ->where('user_id', $parameter2)
                ->where('webinar_id', $parameter1 )
                ->select('bukti_share')
                ->first();

        return Storage::download($getData->bukti_share);
    }


}

