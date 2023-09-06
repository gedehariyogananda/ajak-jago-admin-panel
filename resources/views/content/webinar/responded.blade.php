
@extends('layouts/contentNavbarLayout')

@section('title', 'Responded')

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
                  <th>Team Name</th>
                  <th>Action</th>
              
                </tr>
              </thead>
              <tbody class="table-border-bottom-0">
                @forelse($webinar->users as $wbnr)          
                      <tr>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $wbnr->name}}</strong></td>
                        <td>{{ $wbnr->email }}</td>
                        <td>{{ $wbnr->team->name }}</td>
                        <td>   
                          <div class="row row-cols-lg-auto g-3 align-items-center">

                              {{-- tambah --}}
                              <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{ $wbnr->id }}">
                                <i class='bx bx-street-view'></i>
                              </button>

                          </div>
                            
                        </td>
                        <div class="modal fade" id="staticBackdrop{{ $wbnr->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-scrollable">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Detail DATA PENDAFARAN</h1>
                              
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                <h5><span class="badge bg-label-primary me-1">{{ $wbnr->name }}</span></h5>
                                <div class="row">
                                  <ul class="list-group">
                                    <li class="list-group-item">Name : {{ $wbnr->name }}</li>
                                    <li class="list-group-item">Email : {{ $wbnr->email }}</li>
                                    <li class="list-group-item">Information from : {{ $wbnr->pivot->info }}</li>
                                    {{-- @foreach($detailUser as $key) --}}
                                        {{-- <li><a href="{{ route('webinar.download',[$webinar->id,$wbnr->id]) }}">download</a></li> --}}

                                      <form action="{{ route('webinar.download', [$webinar->id, $wbnr->id]) }}" method="post">
                                
                                        @csrf
                                        <li class="list-group-item">Bukti Follows : 
                                          <button class="btn btn-sm btn-primary" type="submit">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                                              <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                                              <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                                            </svg>  
                                          </button>
                                        </form>
                                    </li>
                                      <form action="{{ route('webinar.downloadBukti', [$webinar->id, $wbnr->id]) }}" method="post">
                                        @csrf
                                        <li class="list-group-item">Bukti Share :
                                          <button class="btn btn-sm btn-primary" type="submit">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                                              <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                                              <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                                            </svg>  
                                          </button>
                                      </form>
                                    </li>
                                    <li class="list-group-item">Next Idea : {{ $wbnr->pivot->next_idea }}</li>
                                    <li class="list-group-item">
                                         <strong class="fs-6">joinned at {{ $wbnr->pivot->created_at->format('d F Y') }}</strong>
                                    </li>
                                  </ul>
                                     
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