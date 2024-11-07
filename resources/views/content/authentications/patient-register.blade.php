@extends('layouts/contentNavbarLayout')

@section('title', 'Add Patient')

@section('page-style')
@vite([
  'resources/assets/vendor/scss/pages/page-auth.scss'
  ])
  @endsection


  @section('content')
  <div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
      <div class="container">
        <!-- Register Card -->
        <div class="card px-sm-6 px-0">
          <div class="card-body">
            <!-- Logo -->
            <div class="app-brand justify-content-center mb-6">
              <a href="{{url('/')}}" class="app-brand-link gap-2">
                <span class="app-brand-text demo text-heading fw-bold">{{ $brandName }}</span>
              </a>
            </div>
            <!-- /Logo -->
            <p class="mb-6 text-center">Add Patient!</p>

            <form class="mb-6 row align-items-center" action="{{ route('patient.register') }}" method="POST">
              @csrf
              <div class="mb-6 col-md-6">
                <label for="name" class="form-label">Patient' Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Patient's name" autofocus>
              </div>
              <div class="mb-6 col-md-6">
                <label for="username" class="form-label">Patient' Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Enter patient's username" autofocus>
              </div>
              <div class="mb-6 col-md-6">
                <label for="phone" class="form-label">Patient' Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter patient's Number" autofocus>
              </div>
              <div class="mb-6 col-md-6">
                <label for="email" class="form-label">Patient' Email (Optional)</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="Enter patient's email">
              </div>

              <div class="mb-6 col-md-6 form-password-toggle">
                <label class="form-label" for="password">Password</label>
                <div class="input-group input-group-merge">
                  <input type="text" name="password" class="form-control bg-light" id="password" readonly>
                </div>
              </div>
              <div class="mb-6 col-md-6">
                <label for="email" class="form-label">Select Doctor</label>
                <select class="form-select" name="doctor">
                  <option disabled selected>Select</option>
                  @foreach($doctors as $doctor)
                  <option value="{{ $doctor->name }}">{{ $doctor->name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="mb-6 col-md">
                <label for="email" class="form-label">Description</label>
                <textarea placeholder="Description" name="description" placeholder="password" class="form-control"></textarea>
              </div>
              <button class="btn btn-primary d-grid w-100">
                Add Patient
              </button>
            </form>
          </div>
        </div>
        <!-- Register Card -->
      </div>
    </div>
  </div>

  <script>
    $('#username').on('input',function(){
      $('#password').val($('#username').val())
    })
  </script>
  @endsection
