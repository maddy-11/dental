@extends('layouts/contentNavbarLayout')

@section('title', 'Change Password')

@section('page-style')
@vite([
  'resources/assets/vendor/scss/pages/page-auth.scss'
  ])
  @endsection

  @section('content')
  <div class="container-xxl">
    <div class="authentication-wrappe authentication-basic container-p-y">
      <div class="authentication-inner">
        <div class="row justify-content-center">
          <div class="col-md-8">
            <div class="card">
              <div class="card px-sm-6 px-0">
                <div class="card-body">
                  <!-- Logo -->
                  <div class="app-brand justify-content-center">
                    <a href="{{url('/')}}" class="app-brand-link gap-2">
                      <span class="app-brand-logo demo">@include('_partials.macros',["width"=>25,"withbg"=>'var(--bs-primary)'])</span>
                      <span class="app-brand-text demo text-heading fw-bold">{{config('variables.templateName')}}</span>
                    </a>
                  </div>
                  <div class="text-center m-auto">
                    <h4 class="mb-1">Want to Change Your Password? 👋</h4>
                    <p class="mb-6">Please Fill the form below</p>
                  </div>
                  <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                      @csrf

                      <div class="form-group">
                        <label for="current_password" class="col-md-4 col-form-label text-md-right">{{ __('Current Password') }}</label>

                        <div >
                          <input id="current_password" type="password" class="form-control @error('current_password') is-invalid @enderror" name="current_password" required autofocus>

                          @error('current_password')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>

                      <div class="form-group ">
                        <label for="new_password" class="col-md-4 col-form-label text-md-right">{{ __('New Password') }}</label>

                        <div >
                          <input id="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password" required>

                          @error('new_password')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>

                      <div class="form-group ">
                        <label for="new_password_confirmation" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                        <div >
                          <input id="new_password_confirmation" type="password" class="form-control" name="new_password_confirmation" required>
                        </div>
                      </div>

                      <div class="form-group my-5">
                        <div class="col-md-8 offset-md-4">
                          <button type="submit" class="btn btn-primary">
                            {{ __('Change Password') }}
                          </button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      @endsection