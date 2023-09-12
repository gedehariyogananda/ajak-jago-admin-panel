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
  <div class="d-flex justify-content-between align-items-center">
  @can('admin only')
    <h5>Category Teams Ajak Jago</h5>
    <a class="btn btn-sm btn-primary items-center" href="{{ route('team.show') }}">
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-terminal-plus" viewBox="0 0 16 16">
      <path d="M2 3a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h5.5a.5.5 0 0 1 0 1H2a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h11a2 2 0 0 1 2 2v4a.5.5 0 0 1-1 0V4a1 1 0 0 0-1-1H2Z"/>
      <path d="M3.146 5.146a.5.5 0 0 1 .708 0L5.177 6.47a.75.75 0 0 1 0 1.06L3.854 8.854a.5.5 0 1 1-.708-.708L4.293 7 3.146 5.854a.5.5 0 0 1 0-.708ZM5.5 9a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1H6a.5.5 0 0 1-.5-.5ZM16 12.5a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Zm-3.5-2a.5.5 0 0 0-.5.5v1h-1a.5.5 0 0 0 0 1h1v1a.5.5 0 0 0 1 0v-1h1a.5.5 0 0 0 0-1h-1v-1a.5.5 0 0 0-.5-.5Z"/>
    </svg> Add New Team</a>
    
  </div>

  @foreach($teams as $team)
    <div class="col-md-3">
      <div class="card my-2">
        <a href="{{ route('show.team', $team) }}">
        <div class="align-center">
          <div class="card">
            <div class="my-3 text-center">
                <h6>{{ $team->name }}</h6>
            </div>
            <hr>
            <div class="d-flex gap-2 mx-2 mb-2">
              @if($team->id > '3')
              <form action="{{ route('team.destroy', $team) }}" method="post">
                @csrf
                @method('delete')

                <button class="btn btn-danger btn-sm" type="submit"><i class='bx bx-trash'></i></button>
              </form>
              
              
              <a href="{{ route('add.editteam', $team) }}" class="btn btn-info btn-sm mx-2"><i class='bx bx-edit'></i></a>
              @endif

              <a class="btn btn-sm btn-primary" href="{{ route('add.addmember', $team) }}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill-add" viewBox="0 0 16 16">
                <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0Zm-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                <path d="M2 13c0 1 1 1 1 1h5.256A4.493 4.493 0 0 1 8 12.5a4.49 4.49 0 0 1 1.544-3.393C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4Z"/>
              </svg></a>

            </div>
          </div>
        </div>
      </a>
      </div>
  </div>
  @endforeach

  <p>#note : click title to spesific name team</p>


  <div class="col-lg-12 my-4 order-0">

      <h5>Detail User <span class="badge bg-label-primary me-1">{{ $tim }}</span></h5>

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
                    <th>Profile Image</th>
                    <th>Team</th>
                    <th>Actions</th>
                
                  </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                  @forelse($users as $user)
                        <tr>
                          <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $user->name }}</strong></td>
                          <td>{{ $user->email }}</td>
                          <td class="text-center">
                            <img src="{{ asset('storage/' . $user->profile_picture) }}" style="width:60px" alt="">
                          </td>
                          @if($user->team)
                            <td><span class="badge bg-label-primary">{{ $user->team->name }}</span></td>
                          @else
                            <td> - </td>
                          @endif
                          <td>   
                            <div class="row row-cols-lg-auto g-3 align-items-center">

                                {{-- see --}}
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{ $user->id }}">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye"
                                  viewBox="0 0 16 16">
                                  <path
                                    d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                  <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                </svg></button>


                                  {{-- edit team--}}
                                  <a href="{{ route('user.edit', $user) }}" class="btn btn-info btn-sm mx-2"><i class='bx bx-edit'></i></a>


                                  @if($user->team_id == '1')
                                  {{-- edit sub team dan profile --}}
                                  <a class="btn btn-sm btn-warning" href="{{ route('useredit.team', $user) }}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill-lock" viewBox="0 0 16 16">
                                    <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm-9 8c0 1 1 1 1 1h5v-1a1.9 1.9 0 0 1 .01-.2 4.49 4.49 0 0 1 1.534-3.693C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4Zm7 0a1 1 0 0 1 1-1v-1a2 2 0 1 1 4 0v1a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1v-2Zm3-3a1 1 0 0 0-1 1v1h2v-1a1 1 0 0 0-1-1Z"/>
                                  </svg></a>
                                  @elseif($user->team_id == '2')

                                    <button class="btn btn-sm btn-secondary" disabled><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill-lock" viewBox="0 0 16 16">
                                      <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm-9 8c0 1 1 1 1 1h5v-1a1.9 1.9 0 0 1 .01-.2 4.49 4.49 0 0 1 1.534-3.693C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4Zm7 0a1 1 0 0 1 1-1v-1a2 2 0 1 1 4 0v1a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1h-4a1 1 0 0 1-1-1v-2Zm3-3a1 1 0 0 0-1 1v1h2v-1a1 1 0 0 0-1-1Z"/>
                                    </svg></button>
                                  @else
                                         {{-- edit sub team dan profile --}}
                                         <a class="btn btn-sm btn-warning" href="{{ route('usereditnoclevel.team', $user) }}"><i class='bx bx-street-view'></i></a>
                                  @endif
                                  
                                  
                              {{-- hapus --}}

                              <form action="{{ route('user.destroy', $user) }}" method="post">
                                @csrf
                                @method('delete')
                                
                                <button class="btn btn-danger btn-sm" type="submit" @if($user->id == Auth::user()->id) disabled @endif><i class='bx bx-trash'></i></button>

                              </form>
                            </div>
                              
                          </td>
                          <div class="modal fade" id="staticBackdrop{{ $user->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable">
                              <div class="modal-content">
                                <div class="modal-body">
                                  <ul class="list-group">
                                    <p >Detail User 
                                      <span class="badge bg-label-primary">{{ $user->name }}</span>
                                    </p>
                                    <li class="list-group-item">Name : {{ $user->name }}</li>
                                    <li class="list-group-item">Email : {{ $user->email }}</li>
                                    @if($user->team)
                                        <li class="list-group-item">Team : {{ $user->team->name }}</li>
                                    @endif
                                    <li class="list-group-item">Level Education : {{ $user->level_education }}</li>
                                    <li class="list-group-item">Provincial Origin : {{ $user->provincial_origin }} </li>
                                    <li class="list-group-item">Wa Number :  {{ $user->wa_number }} </li>
                                    <li class="list-group-item">Institusi : {{ $user->institusi }}</li>
                                    <li class="list-group-item">Age :  {{ $user->age }}</li>
                                    <li class="list-group-item">Sub Team : {{ $user->subteam }}</li>
                                    <li class="list-group-item">Created Account At : {{ $user->created_at->format('d F Y') }}</li>  
                                  </ul>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                              </div>
                            </div>
                          </div>
                    @empty
                    <div class="alert alert-danger">
                        There are no information user about teams u needed
                    </div>
                    @endforelse
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endcan

    @can('staff only')
      <div class="alert alert-danger">
        this page only for IT ADMINISTRATION, if u want to access u have to contact the IT administrator
      </div>
    @endcan


  </div>
</div>

@endsection
