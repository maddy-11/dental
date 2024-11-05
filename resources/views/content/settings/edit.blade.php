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
        <form action="{{ route('timing.update') }}" method="POST">
          @csrf
          @method('put')

          <div class="form-group mb-4">
            <label for="brand_name" class="col-form-label">Clinic Name</label>
            <input type="text" name="brand_name" id="brand_name" class="form-control" 
            value="{{ old('brand_name', config('settings.brand_name')) }}" required>
          </div>

          <div class="form-group mb-4">
            <label for="clinic_phone" class="col-form-label">Clinic Phone</label>
            <input type="text" name="clinic_phone" id="clinic_phone" class="form-control" 
            value="{{ old('clinic_phone', config('settings.clinic_phone')) }}" required>
          </div>

          <div class="form-group mb-4">
            <label class="col-form-label" for="address">Address</label>
            <textarea name="address" id="address" class="form-control" rows="3" required>{{ old('address', config('settings.address')) }}</textarea>
          </div>

          <div class="row">
            <label class="col-form-label" for="end_time">Clinic Timings</label>
            <div class="row m-auto mb-4">
              <div class="col-md-6 d-flex align-items-center">
                <label class="form-label me-2" for="start_time">Start Time</label>
                <input type="number" class="form-control" name="start_time" value="{{ old('start_time', config('settings.start_time')) }}" id="start_time" placeholder="Hour (1-12)" required min="1" max="12" />
              </div>

              <div class="col-md-6 d-flex align-items-center">
                <label class="col-form-label me-2" for="end_time">End Time</label>
                @php
                $endTime = config('settings.end_time');
                $newTime = $endTime > 12 ? $endTime - 12 : $endTime;
                @endphp
                <input type="number" class="form-control" name="end_time" value="{{ old('end_time', $newTime) }}" id="end_time" placeholder="Hour (1-12)" required min="1" max="12" />
              </div>
            </div>

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
