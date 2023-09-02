<?php

namespace App\Http\Controllers;

use App\Http\Requests\WebinarRequest;
use App\Models\Webinar;
use Illuminate\Support\Str;

class WebinarController extends Controller
{
    public function index(){
        $webinars = Webinar::all();
        return view('content.webinar.index', compact('webinars'));
    }

    public function edit(Webinar $webinar){
        return view('content.webinar.edit', compact('webinar'));
    }

    public function update(WebinarRequest $request, Webinar $webinar){
        if($request->image_path == null){  
            $webinar->update($request->all());
        }  else {
                $webinar->update([
                    'title' => $request->title,
                    'description' => $request->description,
                    'datetime' => $request->datetime,
                    'place' => $request->place,
                    'fee' => $request->fee,
                    'video_url' => $request->video_url,
                    'meet_url' => $request->meet_url,
                    'poster_url' => $request->poster_url,
                    'image_path' => $request->file('image_path')->store('pict-webinars-images'),
                ]);
        }

        return redirect('admin/panel-jago-dalam-sehari')->with('success', 'the webinars data has been updated successfully');

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
            'video_url' => $request->video_url,
            'meet_url' => $request->meet_url,
            'poster_url' => $request->poster_url,
            'image_path' => $request->file('image_path')->store('pict-webinars-images'),
        ]);

        return redirect('admin/panel-jago-dalam-sehari')->with('success', 'The Webinar Has Successfully Added');
    }

    public function responded(Webinar $webinar) {
        return view('content.webinar.responded', compact('webinar'));
    }
}

