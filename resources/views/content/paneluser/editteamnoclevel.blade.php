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
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Edit Profile sub team {{ $user->name }}</div>

                @if(session()->has('success'))
                <div class="alert alert-primary">
                  {{ session('success') }}
                </div>
              @endif
              
                <hr>
                <div class="body">
                    <form action="{{ route('usereditnoclevel.update', $user) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <div class="mx-3">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="card text-center">
                                        <img src="{{asset('assets/img/managerr.jpg')}}" alt="Manager" class="card-img-top">
                                        <div class="card-body">
                                            <input type="hidden" name="oldTeam" value="{{ $user->subteam }}">
                                            <label class="custom-checkbox-label d-flex align-items-center">
                                                <input type="checkbox" name="subteam" value="Manager" class="custom-checkbox mr-2">
                                                Manager
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="card text-center">
                                        <img src="{{asset('assets/img/vicemanager.jpeg')}}" alt="Vicemanager" class="card-img-top pb-3">
                                        <div class="card-body">
                                            <label class="custom-checkbox-label d-flex align-items-center">
                                                <input type="checkbox" name="subteam" value="Vicemanager" class="custom-checkbox mr-2">
                                                Vmanager
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="card text-center">
                                        <img src="{{asset('assets/img/associet.jpg')}}" alt="Associate" class="card-img-top">
                                        <div class="card-body">
                                            <label class="custom-checkbox-label d-flex align-items-center">
                                                <input type="checkbox" name="subteam" value="Associate" class="custom-checkbox mr-2">
                                                Associate
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            

                            @error('subteam')
                                {{ $message }}
                            @enderror

                            <label for="">Image</label>
                            <input type="hidden" name="oldImage" value="{{ $user->profile_picture }}">
                            <input type="file" name="profile_picture" class="form-control" id="">
                            @error('profile_picture')
                                {{ $message }}
                            @enderror

                            <button type="submit" class="btn btn-secondary btn-sm my-3">Submitted</button>
                        </div>
                        
                    </form>

                </div>
            </div>
        </div>
    </div>


@endsection