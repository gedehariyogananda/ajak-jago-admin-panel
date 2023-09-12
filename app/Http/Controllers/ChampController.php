<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChampRequest;
use App\Models\Bootcamp;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ChampController extends Controller
{
    public function index(){
        $bootcamps = Bootcamp::orderBy("id")->simplePaginate(3);

        return view('content.bootcamp.index', compact('bootcamps'));
    }

    public function show(){
        return view('content.bootcamp.show');
    }

    public function store(ChampRequest $request){

        Bootcamp::create([
            'title' => $request->title,
            'description' => $request->description,
            'identifier' => Str::random(10),
            'start_date_reg' => $request->start_date_reg,
            'end_date_reg' => $request->end_date_reg,
            'time_long' => $request->time_long,
            'place' => $request->place,
            'fee' => $request->fee,
            'image_path' => $request->file('image_path')->store('pict-bootcamp-images'),
            'wa_group_url' => $request->wa_group_url,
        ]);

        return redirect('admin/panel-jago-champ')->with('success', 'the bootcamp has been added successfully');
    }

    public function edit(Bootcamp $bootcamp){
        return view('content.bootcamp.edit', compact('bootcamp'));
    }

    public function update(ChampRequest $request, Bootcamp $bootcamp){
        if($request->image_path == null){  
            $bootcamp->update($request->all());
        }  else {
                $bootcamp->update([
                    'title' => $request->title,
                    'description' => $request->description,
                    'identifier' => Str::random(10),
                    'start_date_reg' => $request->start_date_reg,
                    'end_date_reg' => $request->end_date_reg,
                    'time_long' => $request->time_long,
                    'place' => $request->place,
                    'fee' => $request->fee,
                    'image_path' => $request->file('image_path')->store('pict-bootcamp-images'),
                    'wa_group_url' => $request->wa_group_url,
                ]);
        } 

        return redirect('admin/panel-jago-champ')->with('success', 'Success updated');
    }

    public function destroy(Bootcamp $bootcamp){
        $bootcamp->delete();

        return back()->with('success', 'successssss');
    }

    public function responded(Bootcamp $bootcamp){
        return view('content.bootcamp.responded', compact('bootcamp'));
        
    }

    // downloader bukti_folows
    public function downloader($parameter1, $parameter2){
       $getData = DB::table('bootcamp_participant')
                ->where('user_id', $parameter2)
                ->where('bootcamp_id', $parameter1)
                ->select('bukti_follows')
                ->first();

        return Storage::download($getData->bukti_follows);
    }

    // bukti shared
    public function downloaderBukti($parameter1, $parameter2){
        $getData = DB::table('bootcamp_participant')
            ->where('user_id', $parameter2)
            ->where('bootcamp_id', $parameter1)
            ->select('bukti_shared')
            ->first();

        return Storage::download($getData->open_regis);
    }

     public function downloaderCv($parameter1,$parameter2){
        $getData = DB::table('bootcamp_participant')
                ->where('user_id', $parameter2)
                ->where('bootcamp_id', $parameter1)
                ->select('file_cv')
                ->first();

        return Storage::download($getData->file_cv);
    }


}
