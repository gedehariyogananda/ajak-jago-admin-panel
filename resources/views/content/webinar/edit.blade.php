@extends('layouts/contentNavbarLayout')

@section('title', 'User Panel')

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
                <div class="card-header">Edit Webinar {{ $webinar->title }}</div>
                <hr>
                <div class="body">
                    <form action="{{ route('webinar.update', $webinar) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div class="mx-3">
                            <label class="label-control my-2" for="">title</label>
                            <input class="form-control" value="{{ $webinar->title }}" type="text" name="title">
                            <label class="label-control my-2" for="">description</label>
                            <input type="text" name="description" class="form-control" value="{{ $webinar->description }}">
                            <label class="label-control my-2" for="">Date</label>
                            <input class="form-control" value="{{ $webinar->datetime }}" type="datetime-local" name="datetime">
                            <label class="label-control my-2" for="">Place</label>
                            <input class="form-control" value="{{ $webinar->place }}" type="text" name="place">
                            <label class="label-control my-2" for="">Fee</label>
                            <input class="form-control" value="{{ $webinar->fee }}" type="text" name="fee">
                            <label class="label-control my-2" for="">Image</label>
                            <input class="form-control" value="#" type="file" name="image_path">
                            <label class="label-control my-2" for="">Video URL</label>
                            <input class="form-control" value="{{ $webinar->video_url }}" type="text" name="video_url">
                            <label class="label-control my-2" for="">Meet URL</label>
                            <input class="form-control" value="{{ $webinar->meet_url }}" type="text" name="meet_url">
                            <label class="label-control my-2" for="">Poster URL</label>
                            <input class="form-control" value="{{ $webinar->poster_url }}" type="text" name="poster_url">
                            <button type="submit" class="btn btn-secondary btn-sm my-3">editted</button>
                        </div>
                        
                    </form>

                </div>
            </div>
        </div>
    </div>


@endsection