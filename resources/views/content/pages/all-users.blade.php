@extends('layouts/contentNavbarLayout')

@section('title', 'All Users')
@section('nav-title', 'All Users')

@section('content')

<!-- Bootstrap Table with Header - Dark -->
<div class="card">
  <div class="d-flex align-items-center justify-content-between">
    <h5 class="card-header">All Users</h5>
    @if(Auth::user()->is_admin == true)
    <a href="{{ route('register') }}" class="btn btn-primary me-2">Add New</a>
    @endif
  </div>
  <div class="table-responsive text-nowrap px-5">
    <table class="table datatable">
              <thead class="table-dark">
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Username</th>
                  <th>Status</th>
                  <th>Salary</th>
                  <th>Phone</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody class="table-border-bottom-0">
                @foreach($users as $user)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td> <span>{{ $user->name }}</span></td>
                  <td> <span>{{ $user->username }}</span></td>
                  <td><span class="badge bg-label-primary me-1">{{ $user->status }}</span></td>
                  <td> <span>{{ $user->salary ?? 'No Salary' }}</span><span class="@if($user->salaryType != 'percentage') d-none @endif">%</span> </td>
                  <td> <span>{{ $user->phone }}</span></td>
                  <td class="text-center">
                    <div class="dropdown">
                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                      <div class="dropdown-menu">
                        @if(Auth::user()->is_admin == true)
                        <a class="dropdown-item" href="{{ route('pages-account-settings-account', ['id'=>$user->id]) }}"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                        <a class="dropdown-item" href="{{ route('account.delete', ['id'=>$user->id]) }}"><i class="bx bx-trash me-1"></i> Delete</a>
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
  $jq(document).ready(function() {
    $jq('#datatable').DataTable();
  });
</script>
@endpush