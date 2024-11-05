@extends('layouts/contentNavbarLayout')

@section('title', 'Patients')
@section('nav-title', 'Patients')

@section('content')
<style type="text/css">
  td, th{
    text-align:center!important;
  }
</style>
<!-- Bootstrap Table with Header - Dark -->
<div class="card">
  <div class="d-flex align-items-center justify-content-between">
  <h4 class="card-header">All Patients</h4>
  @if(Auth::user()->status == 'Doctor' || Auth::user()->is_admin == true)
  <a href="{{ route('patient.register.index') }}" class="btn btn-primary me-2">Add New</a>
  @endif
</div>
  <div class="table-responsive text-nowrap px-5">
    <table class="table datatable">
      <thead class="table-dark">
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Username</th>
          <th>Phone</th>
          <th>Visits</th>
          <th>Prescriptions</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        @foreach($patients as $user)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td> <span>{{ $user->name }}</span></td>
          <td> <span>{{ $user->username }}</span></td>
          <td> <span>{{ $user->phone }}</span></td>
          <td><a href="{{ route('patient.appointments', ['id'=>$user->id]) }}" class="btn btn-primary">All Visits</a></td>
          <td><a href="{{ route('patient.prescription.index', ['id'=>$user->id]) }}" class="btn btn-primary">Prescriptions</a></td>
          <td>
            <div class="dropdown">
              <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
              <div class="dropdown-menu">
                @if(Auth::user()->is_admin == true)
                <a class="dropdown-item" href="{{ route('appointments.doc_patient', ['id' => $user->id, 'status' => 'patient_id']) }}">
                        <i class="bx bx-calendar me-1"></i>Appointments
                      </a>
                <a class="dropdown-item" href="{{ route('patient.edit', ['id'=>$user->id]) }}"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                <a class="dropdown-item" href="{{ route('patient.delete', ['id'=>$user->id]) }}"><i class="bx bx-trash me-1"></i> Delete</a>
                @else
                <a class="dropdown-item" href="javascript:void(0)">Not Admin</a>
                @endif
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
@push('page-scripts')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
<script>
var $jq = $.noConflict(true);
$jq(document).ready(function () {
    $jq('.datatable').DataTable();
});

</script>
@endpush
