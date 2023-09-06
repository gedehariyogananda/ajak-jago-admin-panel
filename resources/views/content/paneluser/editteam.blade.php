@extends('layouts/contentNavbarLayout')

@section('title', 'Edit Profile')

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
        <div class="col-md-6">
            <div class="card">
                <div class="body">
                    <form action="{{ route('useredit.update', $user) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div class="mx-3">
                            <p class="mt-3">Edit Profile Subteam
                                <span class="badge bg-label-primary me-1">{{ $user->name }}</span>
                            </p>
                            <hr>
                            <label class="my-2" for="team_id">Sub Team</label>
                            <input type="text" class="form-control" name="subteam">
                            @error('subteam')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror

                            <label for="">Image</label>
                            <input type="hidden" name="oldImage" value="{{ $user->profile_picture }}">
                            <input type="file" name="profile_picture" value="{{ $user->profile_picture }}" class="form-control" id="">
                            @error('profile_picture')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror

                            <button type="submit" class="btn btn-primary btn-sm my-3">Submitted</button>
                        </div>
                        
                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection