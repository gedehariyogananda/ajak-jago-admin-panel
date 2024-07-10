@extends('layouts/contentNavbarLayout')

@section('title', 'Make a BOOTCAMP')

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
                <div class="card-header">Make Boocamps</div>
                <hr>
                <div class="body">
                    <form action="{{ route('champ.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mx-3">
                            <label class="label-control my-2" for="">title</label>
                            <input class="form-control mb-4" type="text" name="title" value="{{ old('title') }}">
                            @error('title')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="form-floating">
                                <textarea class="form-control" name="description" placeholder="Leave a description here" id="floatingTextarea"></textarea>
                                <label for="floatingTextarea">Description</label>
                                @error('description')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <label class="label-control my-2" for="">Start Date Regist</label>
                            <input class="form-control" type="date" value="{{ old('start_date_reg') }}" name="start_date_reg">
                            @error('start_date_reg')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                            <label class="label-control my-2" for="">End Date Regist</label>
                            <input class="form-control" type="date" value="{{ old('end_date_reg') }}" name="end_date_reg">
                            @error('end_date_reg')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                            <label class="label-control my-2" for="">Fee</label>
                            <input class="form-control" type="text" value="{{ old('fee') }}" name="fee">
                            @error('fee')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                            <label class="label-control my-2" for="">Image</label>
                            <input class="form-control" type="file" name="image_path">
                            @error('image_path')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                            <label class="label-control my-2" for="">Place</label>
                            <input class="form-control" type="text" value="{{ old('place') }}" name="place">
                            @error('place')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                            <label class="label-control my-2" for="">Time Long</label>
                            <input class="form-control" type="text" value="{{ old('time_long') }}" name="time_long">
                            @error('time_long')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                            <label class="label-control my-2" for="">wa_group_url</label>
                            <input class="form-control" type="text" value="{{ old('wa_group_url') }}" name="wa_group_url">
                            @error('wa_group_url')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary btn-sm my-3 ">added</button>

                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>


@endsection