@extends('layouts/contentNavbarLayout')

@section('title', 'Edit Service')
@section('nav-title', 'Services')
@section('content')
<div class="row">
  <!-- Basic Layout -->
  <div class="col-xxl">
    <div class="card mb-6">
      <div class="card-header d-flex align-items-center justify-content-between">
        <h3 class="mb-0">Edit Service</h3> <small class="text-muted float-end">Default label</small>
      </div>
      <div class="card-body">
        <form action="{{ route('service.update', ['id' => $service->id]) }}" method="POST">
          @csrf
          @method('PUT')
          <div class="row mb-6">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Name</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" value="{{ $service->name }}" name="name" id="name" placeholder="Dental Surgery" />
            </div>
          </div>
          <div class="row mb-6">
            <label class="col-sm-2 col-form-label" for="basic-default-company">Description</label>
            <div class="col-sm-10">
              <textarea class="form-control" name="description" class="Description" placeholder="Description">{{ $service->description }}</textarea>
            </div>
          </div>
          <div class="row mb-6">
            <label class="col-sm-2 col-form-label" for="basic-default-phone">Duration in Hours</label>
            <div class="col-sm-10">
              <input type="number" id="duration" value="{{ $service->duration }}" name="duration" class="form-control" placeholder="1"/>
            </div>
          </div>
          <div class="row mb-6">
            <label class="col-sm-2 col-form-label" for="basic-default-email">Price</label>
            <div class="col-sm-10">
              <div class="input-group input-group-merge">
                <input type="number" id="price" value="{{ $service->price }}" name="price" class="form-control" placeholder="1000" />
              </div>
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
