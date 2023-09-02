
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
<div class="col-lg-12 my-4 order-0">

    <h5>Detail Partisipant Webinar <span class="badge bg-label-primary me-1">{{ $webinar->title }}</span></h5>

  @if(session()->has('success'))
    <div class="alert alert-primary">
      {{ session('success') }}
    </div>
  @endif

  <div class="card">
    <div class="d-flex align-items-end row">
        <div class="card-body">
          <!-- Basic Bootstrap Table -->
          <div class="table-responsive text-nowrap">
            <table class="table">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Team</th>
                  <th>Actions</th>
              
                </tr>
              </thead>
              <tbody class="table-border-bottom-0">
                @forelse($webinar->users as $user)
                      <tr>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $user->name }}</strong></td>
                        <td>{{ $user->email }}</td>
                        @if($user->team)
                          <td><span class="badge bg-label-primary me-1">{{ $user->team->name }}</span></td>
                        @else
                          <td> - </td>
                        @endif
                        <td>   
                          <div class="row row-cols-lg-auto g-3 align-items-center">

                              {{-- tambah --}}
                              <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{ $user->id }}">
                                <i class='bx bx-street-view'></i>
                              </button>

                          </div>
                            
                        </td>
                        <div class="modal fade" id="staticBackdrop{{ $user->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-scrollable">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Detail User {{ $user->name }}</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                <div class="row">
                                  <div class="col-sm-12">
                                      <p>Name : {{ $user->name }}</p>
                                      <p>Email : {{ $user->email }}</p>
                                      <p>Team : 
                                        @if($user->team)
                                            {{ $user->team->name }}
                                        @endif
                                      </p>
                                      <p>Level Education : {{ $user->level_education }}</p>
                                      <p>Provincial Origin : {{ $user->provincial_origin }}</p>
                                      <p>Wa Number : {{ $user->wa_number }}</p>
                                      <p>Institusi : {{ $user->institusi }}</p>
                                      <div class="d-flex gap-3">
                                        <p>Profile Picture :</p>
                                        <img src="{{ asset('storage/' . $user->profile_picture) }}" style="width: 25%" alt="">
                                      </div>
                                      <p>Age : {{ $user->age }}</p>
                                      <p>Sub Team : {{ $user->subteam }}</p>
                                      <strong class="fs-6">account joinned at {{ $user->created_at->format('d F Y') }}</strong>
                                  </div>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                              </div>
                            </div>
                          </div>
                        </div>
                  @empty
                  <div class="alert alert-danger">
                      There are no partisipant u needed in our webinars
                  </div>
                  @endforelse

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection