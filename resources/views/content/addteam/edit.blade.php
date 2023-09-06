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
                        <form action="{{ route('add.editteamed', $team) }}" method="post">
                            @csrf
                            @method('patch')
                            <div class="mx-3">
                                <p class="mt-3">Edit Team 
                                    <span class="badge bg-label-primary me-1">{{ $team->name }}</span>
                                </p>
                                <hr>
                                <label class="my-2" for="team_id">Name Team</label>
                                <input type="text" id="team_id" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="{{ $team->name }}">
                                <button type="submit" class="btn btn-primary btn-sm my-3">Submitted</button>
                            </div>
                            
                        </form>

                </div>
            </div>
        </div>
    </div>


@endsection