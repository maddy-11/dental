@extends('layouts/contentNavbarLayout')

@section('title', 'Clinic Settings')
@section('nav-title', 'Clinic Settings')

@section('content')
<div class="row">
  <!-- Basic Layout -->
  <div class="col-xxl">
    <div class="card mb-6">
      <div class="card-header pb-0 d-flex align-items-center justify-content-between">
        <h4 class="m-0">Clinic Settings</h4>
      </div>
      <hr>
      <div class="card-body">
        <form action="{{ route('basics.update') }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('put')

          <!-- Clinic Name -->
          <div class="form-group mb-4">
            <label for="brand_name" class="col-form-label">Clinic Name</label>
            <input type="text" name="brand_name" id="brand_name" class="form-control" value="{{ old('brand_name', config('settings.brand_name')) }}" required>
          </div>

          <!-- Clinic Phone -->
          <div class="form-group mb-4">
            <label for="clinic_phone" class="col-form-label">Clinic Phone</label>
            <input type="tel" name="clinic_phone" id="clinic_phone" class="form-control" value="{{ old('clinic_phone', config('settings.clinic_phone')) }}" required>
          </div>

          <div class="form-group mb-4">
            <label for="clinic_phone" class="col-form-label">Clinic Email</label>
            <input type="text" name="clinic_email" id="clinic_phone" class="form-control" value="{{ old('clinic_phone', config('settings.clinic_email')) }}" required>
          </div>

          <!-- Address -->
          <div class="form-group mb-4">
            <label class="col-form-label" for="address">Address</label>
            <textarea name="address" id="address" class="form-control" rows="3" required>{{ old('address', config('settings.address')) }}</textarea>
          </div>

          <div>
            <button type="submit" class="btn btn-primary form-control">Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection