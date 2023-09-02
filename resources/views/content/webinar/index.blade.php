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
<div class="d-flex justify-content-between">
    <h5>Jago dalam sehari</h5>
    <a class="btn btn-sm btn-primary" href="{{ route('webinar.show') }}">buat form</a>
</div>

@if(session()->has('success'))
    <div class="alert alert-danger">
        {{ session('success') }}
    </div>
@endif

<div class="row">
    @foreach($webinars as $webinar)
    <div class="col-md-4">
        <div class="card">
            <h5 class="mx-3 my-3">{{ $webinar->title }}</h5>

            {{-- the modal button --}}

            {{-- content  --}}
            <div class="d-flex justify-content-end mx-3 my-3">
                <a class="btn btn-sm btn-danger mx-2" href="{{ route('webinar.edit', $webinar) }}">edit</a>
                <a class="btn btn-sm btn-primary text-white" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{ $webinar->id }}">view</a>
                <a class="btn btn-sm btn-secondary mx-2" href="{{ route('webinar.responded', $webinar) }}">see responden</a>
            </div>

        {{-- the modal content view --}}
        <div class="modal fade" id="staticBackdrop{{ $webinar->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="staticBackdropLabel">Detail Webinar {{ $webinar->title }}</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="row">
                        <p>Title : {{ $webinar->title }}</p>
                        <p>Description  : {{ $webinar->description }}</p>
                        <p>Date : {{ $webinar->datetime->format('d F Y, H:i:s') }}</p>
                        <p>Place : {{ $webinar->place }}</p>
                        <p>Fee : {{ $webinar->fee }}</p>
                        <div class="d-flex gap-3">
                            <p>Image : </p>
                            <img src="{{ asset('storage/' . $webinar->image_path) }}" style="width: 25%" alt="">
                        </div>
                        <p class="mt-2">Video URL : {{ $webinar->video_url }}</p>
                        <p>Meet URL : {{ $webinar->meet_url }}</p>
                        <p>Poster URL : {{ $webinar->poster_url }}</p>
                        <p>Created at : {{ $webinar->created_at->format('d F Y') }}</p>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>


        </div>
    </div>
    @endforeach
</div>

@endsection