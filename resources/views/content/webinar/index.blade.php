@extends('layouts/contentNavbarLayout')

@section('title', 'Jago Sehari Panel')

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
<div class="d-flex justify-content-between align-items-center my-2">
  <h3>Jago dalam sehari</h3>
  <a class="btn btn-sm btn-primary" href="{{ route('webinar.show') }}">
    + Add form</a>
</div>

<form action="{{ route('searchWebinar') }}" method="GET">
  <div class="d-flex my-2">
    <input type="text" class="mx-end form-control form-control-sm w-25" name="query" placeholder="Search Webinar By Name" aria-label="Search...">
    <button class="btn btn-sm btn-warning mx-2" type="submit">
        <i class="bx bx-search fs-4 lh-0"></i>
    </button>
  </div>
</form>



<div class="row">
  @foreach($webinars as $webinar)
  <div class="col-md-4 mt-2">
    <div class="card">
      <img src="{{ asset('storage/' . $webinar->image_path) }}" class="card-img-top" alt="">
      <div class="d-flex justify-content-between">
        <h5 class="mx-3 my-3">{{ $webinar->title }}</h5>
        @if($webinar->status == 'open')
        <p class="mx-3 my-3"><span class="badge bg-label-primary me-1">{{ $webinar->status }}</span></p>
        @else
        <p class="mx-3 my-3"><span class="badge bg-label-danger me-1">{{ $webinar->status }}</span></p>
        @endif
      </div>

      {{-- the modal button --}}

      {{-- content --}}
      <div class="d-flex mx-3 my-3">
        <a class="btn btn-sm btn-warning mx-2" href="{{ route('webinar.edit', $webinar) }}"><i
            class='bx bx-edit'></i></a>

        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
          data-bs-target="#staticBackdrop{{ $webinar->id }}">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye"
            viewBox="0 0 16 16">
            <path
              d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
          </svg>
        </button>
  
        <a class="btn btn-sm btn-secondary mx-2" href="{{ route('webinar.responded', $webinar) }}">
          <i class="bx bx-user"></i></a>

        {{-- delete --}}
        <form action="{{ route('webinar.delete', $webinar) }}" method="post">
          @csrf
          @method('delete')
          <button class="btn btn-danger btn-sm mx-1" type="submit"><i class='bx bx-trash'></i></button>
        </form>
      </div>

      {{-- the modal content view --}}
      <div class="modal fade" id="staticBackdrop{{ $webinar->id }}" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-body">
              <p >Detail Webinar 
                <span class="badge bg-label-primary">{{ $webinar->title }}</span>
              </p>
              <div class="row">
                  <div class="text-center container">
                    <img src="{{ asset('storage/' . $webinar->image_path) }}" style="max-width:100%"
                      class="img-fluid rounded" alt="">
                  </div>

                <ul class="list-group container">

                  <li class="list-group-item">Title : {{ $webinar->title }}</li>
                  <li class="list-group-item">Description : {{ $webinar->description }}</li>
                  <li class="list-group-item">Date : {{ $webinar->datetime }}</li>
                  <li class="list-group-item">Place : {{ $webinar->place }}</li>
                  <li class="list-group-item">Fee : {{ $webinar->fee }}</li>
                  <li class="list-group-item">Video URL : {{ $webinar->video_url }}</li>
                  <li class="list-group-item">Meet URL : {{ $webinar->meet_url }}</li>
                  <li class="list-group-item">Poster URL : {{ $webinar->poster_url }}</li>
                  <li class="list-group-item">Created at : {{ $webinar->created_at->format('d F Y') }}</li>
                </ul>
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
<br><br>


@endsection