@extends('layouts/contentNavbarLayout')

@section('title', 'Edit Medicine')
@section('nav-title', 'Medicine')

@section('content')
<div class="row">
  <!-- Basic Layout -->
  <div class="col-xxl">
    <div class="card mb-6">
      <div class="card-header pb-0 mb-0 d-flex align-items-center justify-content-between">
        <h4 class="p-0 m-0">Edit Medicine</h4>
      </div>
      <hr>
      <div class="card-body">
        <form action="{{ route('prescription.medicine.update', ['id'=>$medicine->id]) }}" method="POST">
          @csrf
          <div class="row mb-6">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Name</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" value="{{ $medicine->medicine }}" name="medicine" id="name" placeholder="Medicine" required />
            </div>
          </div>

          <div class="row mb-6">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Dosage</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" value="{{ $medicine->dosage }}" name="dosage" id="dosage" placeholder="500 mg" />
            </div>
          </div>

          <div class="row mb-6">
            <label class="col-sm-2 col-form-label" for="basic-default-name">Description</label>
            <div class="col-sm-10">
              <textarea  class="form-control" name="description" id="desciption" placeholder="Description">{{ $medicine->description }}</textarea>
            </div>
          </div>
          <div class="row justify-content-end">
            <div class="col-sm-10">
              <button type="submit" class="btn btn-primary">Update</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  @endsection
