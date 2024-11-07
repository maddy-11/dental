@extends('layouts/blankLayout')

@section('title', 'Register')

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
            <div class="mb-4">
              <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
            </div>
            <!-- Logo -->
            <div class="app-brand justify-content-center mb-6">
              <a href="{{url('/')}}" class="app-brand-link gap-2">
                <span class="app-brand-logo demo">@include('_partials.macros',["width"=>25,"withbg"=>'var(--bs-primary)'])</span>
                <span class="app-brand-text demo text-heading fw-bold">{{ $brandName }}</span>
              </a>
            </div>
            <!-- /Logo -->
            <p class="mb-6 text-danger text-center">Only Admin can Create Account for a User!</p>

            <form class="mb-6 row align-items-center" action="{{ route('admin.register') }}" method="POST">
              @csrf
              <div class="mb-6 col-md-6">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" autofocus>
              </div>
              <div class="mb-6 col-md-6">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" autofocus>
              </div>
              <div class="mb-6 col-md-6">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter your Number" autofocus>
              </div>
              <div class="mb-6 col-md-6">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email">
              </div>
              <div class="mb-6 col-md-6">
                <label for="email" class="form-label">Select Status</label>
                <select class="form-select" name="status">
                  <option disabled selected>Select</option>
                  @foreach($designations as $designation)
                  <option value="{{ $designation->name }}">{{ $designation->name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="mb-6 col-md-6 form-password-toggle">
                <label class="form-label" for="password">Password</label>
                <div class="input-group input-group-merge">
                  <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                  <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                </div>
              </div>

              <div class="mb-6 col-md-6">
                <p class="form-label">Salary Type</p>
                <div class="btn-group align-items-center justify-content-center col-md-12 col-12" role="group" aria-label="Radio toggle button group">
                  <input type="radio" class="btn-check" value="fix" name="salaryType" id="fixOption" autocomplete="off" checked>
                  <label class="btn btn-outline-primary" for="fixOption">Fix</label>

                  <input type="radio" class="btn-check" value="Percentage" name="salaryType" id="percentageOption" autocomplete="off">
                  <label class="btn btn-outline-primary" for="percentageOption">Percentage</label>
                </div>
              </div>
              <div class="mb-6 col-md-6">
                <label for="salary" class="form-label">Salary</label>
                <div class="input-group rounded">
                  <input type="number" class="form-control rounded" id="salary" name="salary" placeholder="Enter Salary" autofocus>
                  <span class="input-group-text d-none per">%</span>
                </div>
              </div>
              <div class="mb-6 col-md">
                <label for="email" class="form-label">Description</label>
                <textarea placeholder="Description" name="description" class="form-control"></textarea>
              </div>
              <button class="btn btn-primary d-grid w-100">
                Create
              </button>
            </form>
          </div>
        </div>
        <!-- Register Card -->
      </div>
    </div>
  </div>

  <script>
    $(document).ready(function() {
      $('input[name="salaryType"]').change(function() {
        if ($('#fixOption').is(':checked')) {
          $('.per').addClass('d-none')
        }
        else{
          $('.per').removeClass('d-none')
        }
      });
    });
  </script>
  @endsection
