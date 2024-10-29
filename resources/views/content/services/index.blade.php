@extends('layouts/contentNavbarLayout')

@section('title', 'Services')
@section('nav-title', 'Services')

@section('content')

<!-- Bootstrap Table with Header - Dark -->
<div class="card">
  <div class="d-flex align-items-center justify-content-between">
    <h5 class="card-header">Servcices</h5>
    @if(Auth::user()->is_admin == true)
    <a href="{{ route('service.create') }}" class="btn btn-primary me-2">Add New</a>
    @endif
  </div>
  <div class="table-responsive text-nowrap px-5">
    <table class="table datatable">
      <thead class="table-dark">
        <tr>
          <th>Name</th>
          <th class="text-center">Duration</th>
          <th>Price</th>
          <!-- <th>Status</th> -->
          <th class="text-center">Actions</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        @foreach($services as $service)
        <tr>
          <td>{{ $service->name }}</td>
          <td class="text-center">{{ $service->duration }}</td>
          <td>{{ $service->price }}</td>
          <!-- <td>{{ $service->is_active }}</td> -->
          <td class="text-center">
            <div class="dropdown">
              <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('service.edit', ['id' => $service->id]) }}"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                <a class="dropdown-item" href="{{ route('service.delete', ['id' => $service->id]) }}"><i class="bx bx-trash me-1"></i> Delete</a>
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
  $jq(document).ready(function() {
    $jq('#datatable').DataTable();
  });
</script>
@endpush