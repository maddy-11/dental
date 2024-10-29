@extends('layouts/contentNavbarLayout')

@section('title', 'Designations')
@section('nav-title', 'Designations')

@section('content')
<style> 
  td, th{
    text-align:center!important;
  }
</style>
<!-- Bootstrap Table with Header - Dark -->
<div class="card">
  <div class="d-flex align-items-center justify-content-between">
    <h5 class="card-header">Designations</h5>
    @if(Auth::user()->status == 'Doctor' || Auth::user()->is_admin == true)
    <a href="{{ route('designations.create') }}" class="btn btn-primary me-2">Add New</a>
    @endif
    </div>
  <div class="table-responsive text-nowrap">
    <table class="table datatable">
      <thead class="table-dark">
        <tr>
          <th>ID</th>
          <th>Item</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        @foreach($designations as $designation)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $designation->name }}</td>
          <td>
            <div class="dropdown">
              <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('designations.edit', ['designation' => $designation->id]) }}">
                  <i class="bx bx-edit-alt me-1"></i> Edit
                </a>
                    <form action="{{ route('designations.destroy', ['designation' => $designation->id]) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure you want to delete this designation?')">
                            <i class="bx bx-trash me-1"></i> Delete
                        </button>
                    </form>
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
