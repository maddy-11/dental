@extends('layouts/contentNavbarLayout')

@section('title', 'Medicine')
@section('nav-title', 'Medicine')

@section('content')
<style type="text/css">
  td, th{
    text-align:center!important;
  }
</style>
<!-- Bootstrap Table with Header - Dark -->
<div class="card p-5">
  <div class="d-flex justify-content-between">
    <h4 class="card-header p-0 m-0">Medicine</h4>
    <a href="{{ route('prescription.medicine.create') }}" class="btn btn-primary">Add New</a>
  </div>
  <hr>
  <div class="table-responsive text-nowrap">
    <table class="table datatable">
      <thead class="table-dark">
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Dosage</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        @foreach($medicine as $med)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $med->medicine }}</td>
          <td>{{ $med->dosage }}</td>
          <td>
            <div class="dropdown">
              <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('prescription.medicine.edit', ['id' => $med->id]) }}">
                  <i class="bx bx-edit-alt me-1"></i> Edit
                </a>
                <a class="dropdown-item" href="{{ route('prescription.medicine.delete', ['id' => $med->id]) }}">
                  <i class="bx bx-trash me-1"></i> Delete
                </a>
              </div>
            </div>
          </td>
        </tr>
        @endforeach

      </tbody>
    </table>
  </div>
</div>
@endsection
