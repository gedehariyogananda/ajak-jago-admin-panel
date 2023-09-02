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
                <div class="card-header">Make Webinar</div>
                <hr>
                <div class="body">
                    <form action="{{ route('webinar.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mx-3">
                            <label class="label-control my-2" for="">title</label>
                            <input class="form-control mb-4" type="text" name="title">
                            <div class="form-floating">
                                <textarea class="form-control" name="description" placeholder="Leave a description here" id="floatingTextarea"></textarea>
                                <label for="floatingTextarea">Description</label>
                            </div>
                            <label class="label-control my-2" for="">Date</label>
                            <input class="form-control" type="datetime-local" name="datetime">
                            <label class="label-control my-2" for="">Place</label>
                            <input class="form-control" type="text" name="place">
                            <label class="label-control my-2" for="">Fee</label>
                            <input class="form-control" type="text" name="fee">
                            <label class="label-control my-2" for="">Image</label>
                            <input class="form-control" type="file" name="image_path">
                            <label class="label-control my-2" for="">Video URL</label>
                            <input class="form-control" type="text" name="video_url">
                            <label class="label-control my-2" for="">Meet URL</label>
                            <input class="form-control" type="text" name="meet_url">
                            <label class="label-control my-2" for="">Poster URL</label>
                            <input class="form-control" type="text" name="poster_url">
                            <button type="submit" class="btn btn-secondary btn-sm my-3">added</button>
                        </div>
                        
                    </form>

                </div>
            </div>
        </div>
    </div>


@endsection