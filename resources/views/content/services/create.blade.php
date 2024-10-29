@extends('layouts/contentNavbarLayout')

@section('title', 'Create Service')
@section('nav-title', 'Services')

@section('content')
<div class="row">
  <!-- Basic Layout -->
  <div class="col-xxl">
    <div class="card mb-6">
      <div class="card-header d-flex align-items-center justify-content-between">
        <h3 class="mb-0">Add a New Service</h3> <a href="#" class="text-muted float-end">Add New</a>
      </div>
      <div class="card-body">
        <form action="{{ route('service.store') }}" method="POST">
          @csrf
          <div class="row mb-6">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Name</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="name" id="name" placeholder="Dental Surgery" />
            </div>
          </div>
          <div class="row mb-6">
            <label class="col-sm-2 col-form-label" for="basic-default-company">Description</label>
            <div class="col-sm-10">
              <textarea class="form-control" class="Description" name="description" placeholder="Description"></textarea>
            </div>
          </div>
          <div class="row mb-6">
            <label class="col-sm-2 col-form-label" for="basic-default-phone">Duration in Hours</label>
            <div class="col-sm-10">
              <input type="number" id="duration" name="duration" class="form-control" placeholder="1"/>
            </div>
          </div>
          <div class="row mb-6">
            <label class="col-sm-2 col-form-label" for="basic-default-email">Price</label>
            <div class="col-sm-10">
              <div class="input-group input-group-merge">
                <input type="number" id="price" name="price" step="0.01" class="form-control" placeholder="1000" />
              </div>
            </div>
          </div>
          <div class="row justify-content-end">
            <div class="col-sm-10">
              <button type="submit" class="btn btn-primary">Create</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
