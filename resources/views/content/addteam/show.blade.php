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
                <div class="card-header">Make New Team</div>
                <hr>
                <div class="body">
                    <form action="{{ route('team.store') }}" method="post">
                        @csrf
                        <div class="mx-3">
                            <label class="my-2" for="team_id">Name Team</label>
                            <input type="text" id="team_id" name="name" class="form-control @error('name') is-invalid @enderror">
                            <button type="submit" class="btn btn-secondary btn-sm my-3">Submitted</button>
                        </div>
                        
                    </form>

                </div>
            </div>
        </div>
    </div>


@endsection