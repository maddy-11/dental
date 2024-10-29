@extends('layouts/contentNavbarLayout')

@section('title', 'Edit Designation')
@section('nav-title', 'Designations')

@section('content')
<div class="row">
  <!-- Basic Layout -->
  <div class="col-xxl">
    <div class="card mb-6">
      <div class="card-header d-flex align-items-center justify-content-between">
        <h3 class="mb-0">Edit Designation</h3> <small class="text-muted float-end">Default label</small>
      </div>
      <div class="card-body">
        <form action="{{ route('designations.update', ['designation' => $designation->id]) }}" method="POST">
          @csrf
          @method('put')
          <div class="row mb-6">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Name</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="name" value="{{ $designation->name }}" id="name" placeholder="Designation" />
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
