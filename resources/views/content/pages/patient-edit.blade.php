@extends('layouts/blankLayout')

@section('title', 'Register')
@section('nav-title', 'Patients')

@section('page-style')
@vite([
  'resources/assets/vendor/scss/pages/page-auth.scss'
  ])
  @endsection


  @section('content')
  <div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
      <div class="container col-md-10">
        <!-- Register Card -->
        <div class="card px-sm-6 px-0">
          <div class="card-body">
            <!-- Logo -->
            <div class="app-brand justify-content-center mb-6">
              <a href="{{url('/')}}" class="app-brand-link gap-2">
                <span class="app-brand-logo demo">@include('_partials.macros',["width"=>25,"withbg"=>'var(--bs-primary)'])</span>
                <span class="app-brand-text demo text-heading fw-bold">{{config('variables.templateName')}}</span>
              </a>
            </div>
            <!-- /Logo -->
            <p class="mb-6 text-center">Add Patient!</p>

            <form class="mb-6 row align-items-center" action="{{ route('patient.update', ['id' => $patient->id]) }}" method="POST">
              @csrf
              <div class="mb-6 col-md-6">
                <label for="name" class="form-label">Patient' Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $patient->name }}" placeholder="Enter Patient's name" autofocus>
              </div>
              <div class="mb-6 col-md-6">
                <label for="username" class="form-label">Patient' Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Enter patient's username" autofocus value="{{ $patient->username }}">
              </div>
              <div class="mb-6 col-md-6">
                <label for="phone" class="form-label">Patient' Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter patient's Number" autofocus value="{{ $patient->phone }}">
              </div>
              <div class="mb-6 col-md-6">
                <label for="email" class="form-label">Patient' Email (Optional)</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="Enter patient's email" value="{{ $patient->email }}">
              </div>

              <div class="mb-6 col-md-6">
                <label for="email" class="form-label">Select Doctor</label>
                <select class="form-select" name="doctor">
                  <option disabled selected>Select</option>
                  @foreach($doctors as $doctor)
                  <option @if( $patient->doctor == $doctor->name) selected @endif value="{{ $doctor->name }}">{{ $doctor->name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="mb-6 col-md">
                <label for="email" class="form-label">Description</label>
                <textarea placeholder="Description" name="description" placeholder="password" class="form-control">{{$patient->description}}</textarea>
              </div>
              <button class="btn btn-primary d-grid w-100">
                Save
              </button>
            </form>
          </div>
        </div>
        <!-- Register Card -->
      </div>
    </div>
  </div>
  @endsection
