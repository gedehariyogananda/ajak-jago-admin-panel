@extends('layouts/contentNavbarLayout')

@section('title', 'Jago CHAMP')

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
    <h3>Jago champ</h3>
    <a class="btn btn-sm btn-warning mt-2 text-black" href="{{ route('champ.show') }}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cloud-plus" viewBox="0 0 16 16">
      <path fill-rule="evenodd" d="M8 5.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V10a.5.5 0 0 1-1 0V8.5H6a.5.5 0 0 1 0-1h1.5V6a.5.5 0 0 1 .5-.5z"/>
      <path d="M4.406 3.342A5.53 5.53 0 0 1 8 2c2.69 0 4.923 2 5.166 4.579C14.758 6.804 16 8.137 16 9.773 16 11.569 14.502 13 12.687 13H3.781C1.708 13 0 11.366 0 9.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383zm.653.757c-.757.653-1.153 1.44-1.153 2.056v.448l-.445.049C2.064 6.805 1 7.952 1 9.318 1 10.785 2.23 12 3.781 12h8.906C13.98 12 15 10.988 15 9.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 4.825 10.328 3 8 3a4.53 4.53 0 0 0-2.941 1.1z"/>
    </svg> Add Form</a>
</div>

<form action="{{ route('searchBootcamp') }}" method="GET">
  <div class="d-flex my-2">
    <input type="text" class="mx-end form-control form-control-sm w-25" name="query" placeholder="Search Bootcamp By Name" aria-label="Search...">
    <button class="btn btn-sm btn-warning mx-2" type="submit">
        <i class="bx bx-search fs-4 lh-0"></i>
    </button>
  </div>
</form>

<div class="row">
    @forelse($bootcamps as $bootcamp)
    <div class="col-md-4 mt-3">
        <div class="card">
            <img src="{{ asset('storage/' . $bootcamp->image_path) }}" class="card-img-top" alt="">
            <h5 class="mx-3 my-3">{{ $bootcamp->title }}</h5>
            <p class="mx-3 my-3">Start : <span class="badge bg-label-primary me-1">{{ $bootcamp->start_date_reg }}</span></p>
            <p class="mx-3 my-3">End : <span class="badge bg-label-danger me-1">{{ $bootcamp->end_date_reg }}</span></p>

            {{-- content button  --}}
            <div class="d-flex justify-content-end mx-3 my-3">
                {{-- edit --}}
                <a class="btn btn-sm btn-secondary mx-2" href="{{ route('champ.edit', $bootcamp) }}"><i class='bx bx-edit'></i></a>

                {{-- modal view --}}
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{ $bootcamp->id }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye"
                    viewBox="0 0 16 16">
                    <path
                      d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                  </svg>
                </button>
                
                {{-- delete --}}
                    <form action="{{ route('champ.destroy', $bootcamp) }}" method="post">
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger btn-sm mx-2" type="submit"><i class='bx bx-trash'></i></button>
                    </form>

                    
                    <a class="btn btn-sm btn-warning" href="{{ route('champ.responded', $bootcamp) }}"><i class="bx bx-user"></i></a>
            </div>

        {{-- the modal content view --}}
        <div class="modal fade" id="staticBackdrop{{ $bootcamp->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
              <div class="modal-content">
                <div class="modal-body">
                  <p>Detail Bootcamp 
                    <span class="badge bg-label-primary">{{ $bootcamp->title }}</span>
                  </p>
                  <hr>
                    <div class="text-center container">
                        <img src="{{ asset('storage/' . $bootcamp->image_path) }}" style="max-width:100%" class="img-fluid rounded" alt="">
                      </div>
                    <ul class="list-group mt-2">
                        <li class="list-group-item">Title : {{ $bootcamp->title }}</li>
                        <li class="list-group-item">Description  : {{ $bootcamp->description }}</li>
                        <li class="list-group-item">Start : {{ $bootcamp->start_date_reg}}</li>
                        <li class="list-group-item">End : {{ $bootcamp->end_date_reg }}</li>
                        <li class="list-group-item">Place : {{ $bootcamp->place }}</li>
                        <li class="list-group-item">Fee : {{ $bootcamp->fee }}</li>
                        <li class="list-group-item">Time Long : {{ $bootcamp->time_long }}</li>
                        <li class="list-group-item" class="mt-2">Wa Group URL : {{ $bootcamp->wa_group_url }}</li>
                     </ul>
                        
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
    @empty  
    <div class="alert alert-danger">
     <p class="text-center">Not Found !!!</p>
    </div>
    @endforelse
</div>


@endsection