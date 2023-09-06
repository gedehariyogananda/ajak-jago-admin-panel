@extends('layouts/contentNavbarLayout')

@section('title', 'Add Team')

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
                <form action="{{ route('add.edituser', $team) }}" method="post">
                    @csrf
                    @method('patch')
                    <div class="mx-3">
                        <div class="mx-3">
                            <p class="mt-3">Add Member to Team  
                                <span class="badge bg-label-primary me-1">{{ $team->name }}</span>
                            </p>
                            <hr>
                            <input type="hidden" name="team_id" value="{{ $team->id }}">
                            <label class="my-2" for="team_id">User</label>
                            <select class="form-select" name="user_id" id="team_id">
                                <option selected disabled @readonly(true)>-- Select --</option>
                                @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-primary btn-sm my-3">Submitted</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection