@extends('layouts/contentNavbarLayout')

@section('title', 'Clinic Timings')
@section('nav-title', 'Clinic Timings')

@section('content')
<div class="row">
  <!-- Basic Layout -->
  <div class="col-xxl">
    <div class="card mb-6">
      <div class="card-header pb-0 d-flex align-items-center justify-content-between">
        <h4 class="m-0 p-0">Change Timings</h4>
      </div>
        <hr>
      <div class="card-body">
        <form action="{{ route('timing.update') }}" method="POST">
          @csrf
          @method('put')
          <div class="row mb-6">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Start Time</label>
            <div class="col-sm-10">
              <input type="number" class="form-control-lg border" name="start_time" value="{{ $timings->start_time ?? '' }}" id="name" placeholder="Hour" /><span class="m-5">AM</span>
            </div>
          </div>

          <div class="row mb-6">
            <label class="col-sm-2 col-form-label" for="basic-default-name">End Time</label>
            <div class="col-sm-10">
              @php
              if ($timings && $timings->end_time && $timings->end_time > 12) {
                $end_time = $timings->end_time - 12;
              }
              @endphp
              <input type="number" class="form-control-lg border" name="end_time" value="{{ $end_time ?? '' }}" id="name" placeholder="Hour" /><span class="m-5">PM</span>
            </div>
          </div>


          <div class="row justify-content-end">
            <div class="col-sm-10">
              <button type="submit" class="btn btn-primary">Save</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  @endsection
