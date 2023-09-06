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
                <form action="{{ route('webinar.update', $webinar) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('patch')
                    <div class="mx-3">
                        <p class="mt-3">Edit Webinar 
                            <span class="badge bg-label-primary">{{ $webinar->title }}</span>
                          </p>
                          <hr>
                        <div class="form-group">
                            <label class="label-control my-2" for="">title</label>
                            <input class="form-control" value="{{ $webinar->title }}" type="text" name="title">
                            @error('title')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label class="label-control my-2" for="">description</label>
                            <input type="text" name="description" class="form-control"
                                value="{{ $webinar->description }}">
                            @error('description')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <label class="label-control my-2" for="">Date</label>
                        <input class="form-control" value="{{ $webinar->datetime }}" type="datetime-local"
                            name="datetime">
                        @error('datetime')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                        @enderror
                        <label class="label-control my-2" for="">Place</label>
                        <input class="form-control" value="{{ $webinar->place }}" type="text" name="place">
                        @error('place')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                        @enderror
                        <label class="label-control my-2" for="">Fee</label>
                        <input class="form-control" value="{{ $webinar->fee }}" type="text" name="fee">
                        @error('fee')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                        @enderror
                        <label class="label-control my-2" for="">Image</label>
                        <input class="form-control" value="#" type="file" name="image_path">
                        @error('image_path')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                        @enderror
                        <div class="form-group">
                            <label class="my-2" for="">Status Webinar</label>
                            <select name="status" class="form-control">
                                <option value="open" {{ ($webinar->status == 'open') ? 'selected' : '' }}>Open</option>
                                <option value="closed" {{ ($webinar->status == 'closed') ? 'selected' : '' }}>Closed
                                </option>
                            </select>
                        </div>
                        <label class="label-control my-2" for="">Video URL</label>
                        <input class="form-control" value="{{ $webinar->video_url }}" type="text" name="video_url">
                        @error('video_url')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                        @enderror
                        <label class="label-control my-2" for="">Meet URL</label>
                        <input class="form-control" value="{{ $webinar->meet_url }}" type="text" name="meet_url">
                        @error('meet_url')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                        @enderror
                        <label class="label-control my-2" for="">Poster URL</label>
                        <input class="form-control" value="{{ $webinar->poster_url }}" type="text" name="poster_url">
                        @error('poster_url')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                        @enderror
                        <button type="submit" class="btn btn-primary btn-sm my-3">Submit</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>


@endsection