@extends('layouts/contentNavbarLayout')

@section('title', 'Edit Webinar')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}">
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/dashboards-analytics.js')}}"></script>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                
                <div class="body">
                    <form action="{{ route('champ.update', $bootcamp) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div class="mx-3">
                            <p class="mt-3">Edit Bootcamp 
                                <span class="badge bg-label-primary">{{ $bootcamp->title }}</span>
                              </p>
                              <hr>
                            <label class="label-control my-2" for="">title</label>
                            <input class="form-control" value="{{ $bootcamp->title }}" type="text" name="title">
                            @error('title')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <label class="label-control my-2" for="">description</label>
                            <input type="text" name="description" class="form-control" value="{{ $bootcamp->description }}">
                            @error('description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <label class="label-control my-2" for="">Start</label>
                            <input class="form-control" value="{{ $bootcamp->start_date_reg }}" type="datetime-local" name="start_date_reg">
                            @error('start_date_reg')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <label class="label-control my-2" for="">End</label>
                            <input class="form-control" value="{{ $bootcamp->end_date_reg }}" type="datetime-local" name="end_date_reg">
                            @error('end_date_reg')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <label class="label-control my-2" for="">Place</label>
                            <input class="form-control" value="{{ $bootcamp->place }}" type="text" name="place">
                            @error('place')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <label class="label-control my-2" for="">Fee</label>
                            <input class="form-control" value="{{ $bootcamp->fee }}" type="text" name="fee">
                            @error('fee')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <label class="label-control my-2" for="">Image</label>
                            <input class="form-control" value="#" type="file" name="image_path">
                            @error('image_path')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <label class="label-control my-2" for="">Time Long</label>
                            <input class="form-control" value="{{ $bootcamp->time_long }}" type="text" name="time_long">
                            @error('time_long')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <label class="label-control my-2" for="">Wa Group</label>
                            <input class="form-control" value="{{ $bootcamp->wa_group_url }}" type="text" name="wa_group_url">
                            @error('wa_group_url')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <button type="submit" class="btn btn-secondary btn-sm my-3">editted</button>
                        </div>
                        
                    </form>

                </div>
            </div>
        </div>
    </div>


@endsection