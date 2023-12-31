@extends('layouts/contentNavbarLayout')

@section('title', 'Edit Team')

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
                    <form action="{{ route('user.update', $user) }}" method="post">
                        @csrf
                        @method('patch')
                        <div class="mx-3">
                            <p class="mt-3">Edit Team 
                                <span class="badge bg-label-primary me-1">{{ $user->name }}</span>
                            </p>
                            <hr>
                            <label class="my-2" for="team_id">Team</label>
                            <select class="form-select" name="team_id" id="team_id">
                                <option selected disabled>Open this select menu</option>
                                @foreach($teams as $team)
                                    <option value="{{ $team->id }}">{{ $team->name }}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-primary btn-sm my-3">Submitted</button>
                        </div>
                        
                    </form>

                </div>
            </div>
        </div>
    </div>


@endsection