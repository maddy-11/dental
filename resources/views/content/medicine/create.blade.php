@extends('layouts/contentNavbarLayout')

@section('title', 'Add Medicine')
@section('nav-title', 'Medicine')

@section('content')
<div class="row">
  <!-- Basic Layout -->
  <div class="col-xxl">
    <div class="card mb-6">
      <div class="card-header pb-0 mb-0 d-flex align-items-center justify-content-between">
        <h4 class="p-0 m-0">Add a New Medicine</h4>
      </div>
      <hr>
      <div class="card-body">
        <form action="{{ route('prescription.medicine.store') }}" method="POST">
          @csrf
          <div class="row mb-6">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Name</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="medicine" id="name" placeholder="Medicine" />
            </div>
          </div>

          <div class="row mb-6">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Description</label>
            <div class="col-sm-10">
              <textarea  class="form-control" name="description" id="desciption" placeholder="Description"></textarea>
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