@extends('layouts/blankLayout')

@section('title', 'Login Panel Pages')

@section('page-style')
<!-- Page -->
<link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-auth.css')}}">
@endsection

@section('content')
<div class="container-xxl">
  <div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner">
      <!-- Register -->
      <div class="card">
        <div class="card-body">
          <!-- Logo -->
          <div class="app-brand justify-content-center">
            <a href="{{url('/')}}" class="app-brand-link gap-2">
              {{-- <span class="app-brand-logo demo">@include('_partials.macros',["width"=>25,"withbg"=>'#696cff'])</span> --}}
              <span class="app-brand-text demo text-body fw-bolder">{{config('variables.templateName')}}</span>
            </a>
          </div>
          <!-- /Logo -->
          <h4 class="mb-2">Welcome to Admin Panel Ajak Jago! 👋</h4>
          <p class="mb-4">Please sign-in to your account</p>

          <form id="formAuthentication" class="mb-3" action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

              @error('email')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror

            </div>
            <div class=" form-password-toggle">
            <label class="form-label" for="password">Password</label>

              </div>
              <div class="input-group">
                {{-- <input type="password" id="password" class="form-control  @error('password') is-invalid @enderror" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" /> --}}
                {{-- <span class="input-group-text cursor-pointer"></span> --}}
                {{-- <i class="bi bi-eye-slash"></i> --}}

                <input type="password" class="form-control" name="password" id="password" />
                <i class="bi bi-eye-slash" id="togglePassword"></i>

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                
              </div>
            </div>
            <div class="mb-3 mx-3">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember">
                  Remember Me
                </label>
              </div>
            </div>
            <div class="mb-3  mx-3">
              <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<script>
  const togglePassword = document.querySelector('#togglePassword');
  const password = document.querySelector('#password');
  togglePassword.addEventListener('click', () => {
      // Toggle the type attribute using
      // getAttribure() method
      const type = password
          .getAttribute('type') === 'password' ?
          'text' : 'password';
      password.setAttribute('type', type);
      // Toggle the eye and bi-eye icon
      this.classList.toggle('bi-eye');
  });
</script>
@endsection
