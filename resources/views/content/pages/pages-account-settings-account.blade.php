@extends('layouts/contentNavbarLayout')

@section('title', 'Profile')
@section('nav-title', 'Profile')
@section('page-script')
@vite(['resources/assets/js/pages-account-settings-account.js'])
@endsection
@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="mb-6">
      
      <div class="">
        <div class="authentication-wrapper authentication-basic container-p-y">
          <div>
            <!-- Register Card -->
            <div class="card px-sm-6 px-0">
              <div class="card-body">
                <h3>Edit Profile</h3>
                <hr>

                <form class="mb-6 row align-items-center" action="{{ route('user.update', ['id' => $user->id]) }}" method="POST">
                  @csrf
                  @method('put')
                  <div class="mb-6 col-md-6">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" value="{{ $user->name }}" autofocus>
                  </div>
                  <div class="mb-6 col-md-6">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" value="{{ $user->username }}" name="username" placeholder="Enter your username" autofocus>
                  </div>
                  <div class="mb-6 col-md-6">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone" value = "{{ $user->phone }}" placeholder="Enter your Number" autofocus>
                  </div>
                  <div class="mb-6 col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control" id="email" name="email" value = "{{ $user->email }}" placeholder="Enter your email">
                  </div>

                  @if($user->is_admin != true)
                  <div class="mb-6 col-md-6">
                    <p class="form-label">Salary Type</p>
                    <div class="btn-group align-items-center justify-content-center col-md-12 col-12" role="group" aria-label="Radio toggle button group">
                      <input type="radio" class="btn-check" value="fix" name="salaryType" id="fixOption"  autocomplete="off" @if($user->salaryType == 'fix')  checked @endif @if(!Auth::user()->is_admin) disabled @endif>
                      <label class="btn btn-outline-primary" for="fixOption">Fix</label>

                      <input type="radio" class="btn-check" value="percentage" name="salaryType" id="percentageOption" autocomplete="off"  @if($user->salaryType == 'percentage')  checked @endif @if(!Auth::user()->is_admin) disabled @endif>
                      <label class="btn btn-outline-primary" for="percentageOption">Percentage</label>
                    </div>
                  </div>
                  <div class="mb-6 col-md-6">
                    <label for="salary" class="form-label">Salary</label>
                    <div class="input-group rounded">
                      <input type="number" class="form-control" id="salary" value="{{ $user->salary }}" name="salary" placeholder="Enter Salary" autofocus @if(!Auth::user()->is_admin) readonly @endif>
                      <span class="input-group-text d-none per">%</span>
                    </div>
                  </div>
                  @endif
                  <div class="mb-6 col-md-6">
                    <label for="email" class="form-label">Select Status</label>
                    @if(!Auth::user()->is_admin)
                    <input type="text" name="status" class="form-control" readonly value="{{ $user->status }}">
                    @else
                    <select class="form-select" name="status">
                      <option disabled selected>Select</option>
                      @foreach($designations as $designation)
                      <option value="{{ $designation->name }}" @if( $designation->name == $user->status) selected @endif >{{ $designation->name }}</option>
                      @endforeach
                    </select>
                    @endif
                  </div>
                  <div class="mb-6 col-md">
                    <label for="email" class="form-label">Description</label>
                    <textarea rows="1" placeholder="Description" name="description" class="form-control">{{ $user->description }}</textarea>
                  </div>
                  <button class="btn btn-primary d-grid w-100">
                    Save
                  </button>
                </form>
              </div>
            </div>
            <!-- Register Card -->
          </div>
        </div>
      </div>
      <!-- /Account -->
    </div>
    {{-- Reset password --}}
    @if(Auth::user()->is_admin && $user->is_admin != true )
    <div class="card">
      <h5 class="card-header">Reset Password</h5>
      <div class="card-body">
        <div class="mb-6 col-12 mb-0">
          <div class="alert alert-info">
            <h5 class="alert-heading mb-1">Clicking the Button will Reset the Password?</h5>
            <p class="mb-0">Once you reset the password, the user can use their username to log in.</p>
          </div>
        </div>
        <form id="formAccountDeactivation" action="{{ route('password.reset', ['id'=>$user->id]) }}" method="POST">
          @csrf
          <button class="btn btn-primary">Reset Password</button>
        </form>
      </div>
    </div>
    <hr>
    @endif
    {{-- delete --}}
    <div class="card">
      <h5 class="card-header">Delete Account</h5>
      <div class="card-body">
        <div class="mb-6 col-12 mb-0">
          <div class="alert alert-warning">
            <h5 class="alert-heading mb-1">Are you sure you want to delete this account?</h5>
            <p class="mb-0">Once you delete the account, there is no going back. Please be certain.</p>
          </div>
        </div>
        <form id="formAccountDeactivation" method="POST" action="{{ route('account.delete', ['id'=>$user->id]) }}">
          @csrf
          <div class="form-check my-8 ms-2">
            <input class="form-check-input" type="checkbox" name="accountActivation" id="accountActivation" />
            <label class="form-check-label" for="accountActivation">I confirm this account deletion</label>
          </div>
          <button class="btn btn-danger deactivate-account" disabled>Delete Account</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $('#accountActivation').change(function() {
    if($(this).is(':checked')){
      $('.deactivate-account').prop('disabled',false)
    }
    else{
      $('.deactivate-account').prop('disabled',true)
    }
  })
  checkP();
  function checkP(){
    if ($('#fixOption').is(':checked')) {
      $('.per').addClass('d-none')
    }
    else{
      $('.per').removeClass('d-none')
    }
  }
  $(document).ready(function() {
    $('input[name="salaryType"]').change(function() {
      checkP();
    });
  });
</script>
@endsection
