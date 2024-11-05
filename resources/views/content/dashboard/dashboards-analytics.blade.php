@extends('layouts/contentNavbarLayout')

@section('title', 'Dashboard')
@section('nav-title', 'Dashboard')

@section('content')
@include('content.examination.historyModal')
</head>
<body>

  <div class="mt-5">
    @if(Auth::user()->is_admin == true)
    <div class="row" style="justify-content: space-between!important;">
      <!-- Total Patients Card -->
      <div class="col-12 col-md-6 col-xl-3 mb-3">
        <div class="card text-white text-center" style="background:#a38cc6">
          <div class="card-body">
            <h6 class="card-title text-white">Total Patients</h6>
            <div class="d-flex align-items-center justify-content-center">
              <i class="fa fa-users fa-2x me-3"></i>
              <h5 class="mb-0 text-white">{{ $total_patients }}</h5>
            </div>
            <!-- <p class="mt-3 mb-0">Active Patients<span class="float-right">740</span></p> -->
          </div>
        </div>
      </div>

      <!-- Total Doctors Card -->
      <div class="col-12 col-md-6 col-xl-3 mb-3">
        <div class="card text-white" style="background: #dc3545">
          <div class="card-body">
            <h6 class="card-title text-white text-center">Total Doctors</h6>
            <div class="d-flex align-items-center justify-content-center">
              <i class="fa fa-user-md fa-2x me-3"></i>
              <h5 class="mb-0 text-white">{{ $total_doctors }}</h5>
            </div>
            <!-- <p class="mt-3 mb-0">Available Doctors<span class="float-right">50</span></p> -->
          </div>
        </div>
      </div>

      <!-- Total Appointments Card -->
      <div class="col-12 col-md-6 col-xl-3 mb-3">
        <div class="card text-white" style="background:#f4a500">
          <div class="card-body">
            <h6 class="card-title text-white text-center">Total Appointments</h6>
            <div class="d-flex align-items-center justify-content-center">
              <i class="fa fa-calendar fa-2x me-3"></i>
              <h5 class="mb-0 text-white">{{ $total_appointments }} </h5><span class="small ms-2">(In Last 30 Days)</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Total Payments Card -->
      <div class="col-12 col-md-6 col-xl-3 mb-3">
        <div class="card text-white " style="background: rgb(16 64 74);">
          <div class="card-body">
            <h6 class="card-title text-white text-center">Total Payments</h6>
            <div class="d-flex align-items-center justify-content-center">
              <i class="fa fa-credit-card fa-2x me-3"></i>
              <h5 class="mb-0 text-white">{{ $total_payments }}</h5>
            </div>
            <!-- <p class="mt-3 mb-0">Pending Payments<span class="float-right">$3,500</span></p> -->
          </div>
        </div>
      </div>
    </div>
  </div>
  <hr>
  {{-- graph --}}
  <div id="appointmentModal" class="card p-5" style="display:none;height: 350px;width: 100%;">
    <canvas id="appointmentChart"></canvas>
  </div>
  <hr>
  @endif

  <div class="card">
    <div class="d-flex align-items-center justify-content-between">
      <h5 class="card-header">Active Appointments</h5>
      @if(Auth::user()->status == 'Doctor' || Auth::user()->is_admin == true)
      <a href="{{ route('appointments.create') }}" class="btn btn-primary me-2">Add New</a>
      @endif
    </div>
    <hr class="m-0 p-0">
    <div class="table-responsive text-nowrap px-5">
      <table class="table datatable">
        <thead class="table-dark">
          <tr>
            <th>Patient Name</th>
            <th>Doctor</th>
            <th>Service</th>
            <th>Date And Time</th>
            <th>Phone</th>
            <th>Examination</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          @foreach($appointments as $appointment)
          <tr>
            <td>{{ $appointment->name }}</td>
            <td>{{ $appointment->user->name ?? '' }}</td>
            <td>{{ $appointment->service->name ?? '' }}</td>
            <td>{{ \Carbon\Carbon::parse($appointment->start_date_time)->format('D, F j, Y g:i A') }}</td>
            <td>{{ $appointment->phone }}</td>
            <td>
              @if(\Auth::user()->status == "Patient")
              @if($appointment->patient)
              <button class="btn btn-warning historyModalBtn" id="historyModalBtn" data-patient_id="{{ $appointment->patient_id }}">History</button>
              @else
              <td>No History</td>
              @endif
              @else
              <a href="{{ route('examination.create', ['id'=>$appointment->id]) }}" class="btn btn-primary">Examination</a>
              @endif
            </td>
            <td class="text-center">
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                <div class="dropdown-menu">
                  @if(Auth::user()->is_admin == true)
                  <a class="dropdown-item" href="{{ route('appointments.edit', ['id' => $appointment->id]) }}"><i class="bx bx-edit me-1"></i> Edit</a>
                  <a class="dropdown-item" href="{{ route('appointments.delete', ['id' => $appointment->id]) }}"><i class="bx bx-trash me-1"></i> Delete</a>
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
  <hr class="my-5">
  @if (Auth::user()->is_admin == true)
  <div class="mt-5 card">
    <ul class="nav nav-tabs" id="tabSection1" role="tablist">
      <li class="nav-item" role="presentation">
        <a class="nav-link active" id="home-tab1" data-bs-toggle="tab" href="#home1" role="tab" aria-controls="home" aria-selected="true">All Staff</a>
      </li>
      <li class="nav-item" role="presentation">
        <a class="nav-link" id="profile-tab1" data-bs-toggle="tab" href="#profile1" role="tab" aria-controls="profile" aria-selected="false">Doctors</a>
      </li>
      <li class="nav-item" role="presentation">
        <a class="nav-link" id="contact-tab1" data-bs-toggle="tab" href="#contact1" role="tab" aria-controls="contact" aria-selected="false">Patients</a>
      </li>
    </ul>
    <div class="tab-content" id="tabContent1">
      <div class="tab-pane fade show active" id="home1" role="tabpanel" aria-labelledby="home-tab1">
        {{-- all table --}}
        <div>
          <div class="table-responsive text-nowrap">
            <table class="table datatable">
              <thead class="table-dark">
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Email</th>
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
                  <td> <span>{{ $user->email }}</span></td>
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
      </div>
      {{-- // doctor table --}}
      <div class="tab-pane fade" id="profile1" role="tabpanel" aria-labelledby="profile-tab1">
        <div >
          <div class="table-responsive text-nowrap">
            <table class="table datatable">
              <thead class="table-dark">
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Status</th>
                  <th>Salary</th>
                  <th>SalaryType</th>
                  <th>Phone</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody class="table-border-bottom-0">
                @foreach($doctors as $user)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td> <span>{{ $user->name }}</span></td>
                  <td> <span>{{ $user->email }}</span></td>
                  <td><span class="badge bg-label-primary me-1">{{ $user->status }}</span></td>
                  <td class="text-center"> <span>{{ $user->salary ?? 'No Salary' }}</span><span class="@if($user->salaryType != 'percentage') d-none @endif">%</span> </td>
                  <td> <span>{{ $user->salaryType }}</span></td>
                  <td> <span>{{ $user->phone }}</span></td>
                  <td class="text-center">
                    <div class="dropdown">
                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                      <div class="dropdown-menu">
                        @if(Auth::user()->is_admin == true)
                        <a class="dropdown-item" href="{{ route('appointments.doc_patient', ['id' => $user->id, 'status' => 'user_id']) }}">
                          <i class="bx bx-calendar me-1"></i>Appointments
                        </a>
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
      </div>

      {{-- patient table --}}
      <div class="tab-pane fade" id="contact1" role="tabpanel" aria-labelledby="contact-tab1">
        <div >
          <div class="table-responsive text-nowrap">
            <table class="table datatable">
              <thead class="table-dark">
                <tr>
                  <th>ID</th>
                  <th>Name</th>
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
                  <td> <span>{{ $user->phone }}</span></td>
                  <td><a href="{{ route('patient.appointments', ['id'=>$user->id]) }}" class="btn btn-primary">All Visits</a></td>
                  <td><a href="{{ route('patient.prescription.index', ['id'=>$user->id]) }}" class="btn btn-primary">Prescriptions</a></td>
                  <td class="text-center">
                    <div class="dropdown">
                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                      <div class="dropdown-menu">
                        @if(Auth::user()->is_admin == true)
                        <a class="dropdown-item" href="{{ route('appointments.doc_patient', ['id' => $user->id, 'status' => 'patient_id']) }}">
                          <i class="bx bx-calendar me-1"></i>Appointments
                        </a>
                        <a class="dropdown-item" href="{{ route('patient.edit', ['id'=>$user->id]) }}"><i class="bx bx-edit-alt me-1"></i> Edit</a>
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
      </div>
    </div>
  </div>
  @elseif(Auth::user()->status != 'Patient' && !$patients->isEmpty())
  <div class="card">
    <h5 class="card-header">My Patients</h5>
    <div class="table-responsive text-nowrap px-5">
      <table class="table datatable">
        <thead class="table-dark">
          <tr>
            <th>ID</th>
            <th>Name</th>
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
            <td> <span>{{ $user->phone }}</span></td>
            <td><a href="{{ route('patient.appointments', ['id'=>$user->id]) }}" class="btn btn-primary">All Visits</a></td>
            <td><a href="{{ route('patient.prescription.index', ['id'=>$user->id]) }}" class="btn btn-primary">Prescriptions</a></td>
            <td class="text-center">
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                <div class="dropdown-menu">
                  @if(Auth::user()->is_admin == true)
                  <a class="dropdown-item" href="{{ route('appointments.doc_patient', ['id' => $user->id, 'status' => 'patient_id']) }}">
                    <i class="bx bx-calendar me-1"></i>Appointments
                  </a>
                  <a class="dropdown-item" href="{{ route('patient.edit', ['id'=>$user->id]) }}"><i class="bx bx-edit-alt me-1"></i> Edit</a>
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
  @endif
  @if (Auth::user()->is_admin == true)
  <hr class="my-5">

  <div class="card">
    <div class="d-flex align-items-center justify-content-between">
      <h5 class="card-header">Servcices</h5>
      @if(Auth::user()->status == 'Doctor' || Auth::user()->is_admin == true)
      <a href="{{ route('service.create') }}" class="btn btn-primary me-2">Add New</a>
      @endif
    </div>
    <div class="table-responsive text-nowrap px-5">
      <table class="table datatable">
        <thead class="table-dark">
          <tr>
            <th>Name</th>
            <th>Duration</th>
            <th>Price</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          @foreach($services as $service)
          <tr>
            <td>{{ $service->name }}</td>
            <td>{{ $service->duration }}</td>
            <td>{{ $service->price }}</td>
            <td>{{ $service->is_active }}</td>
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

  @endif
  <style type="text/css">
    td, th{
      text-align:center !important;
    }
  </style>
  @endsection
  @push('page-scripts')
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <script>
    $(document).ready(function() {
        // Fetch data
      $.ajax({
        url: '/appointments/last-30-days',
        url: '{{ route('appointments.last.30_days') }}',
        method: 'GET',
        success: function(data) {
          const labels = Object.keys(data).reverse().map(date => formatDate(date));
          const values = Object.values(data).reverse();
          createChart(labels, values);
          $('#appointmentModal').fadeIn();
        },
        error: function() {
          console.error('Error fetching appointment data');
        }
      });
    });

    function formatDate(dateString) {
      const date = new Date(dateString);
      const options = { month: 'short', day: 'numeric' };
      return date.toLocaleDateString('en-US', options);
    }

    function createChart(labels = [], data = []) {
      const ctx = document.getElementById('appointmentChart').getContext('2d');

  // Provide default data if labels or data arrays are empty
      if (labels.length === 0 || data.length === 0) {
        labels = ['Day 1', 'Day 2', 'Day 3', 'Day 4', 'Day 5'];
        data = [3, 7, 4, 8, 6];
      }

      const chartOptions = {
        responsive: true,
        maintainAspectRatio: false,
      };

  // Check if there's an existing chart instance, and destroy it if valid
      if (window.appointmentChart instanceof Chart) {
        window.appointmentChart.destroy();
      }

  // Create a new chart instance and assign it to window.appointmentChart
      window.appointmentChart = new Chart(ctx, {
        type: 'line',
        data: {
          labels: labels,
          datasets: [{
            label: 'Appointments in Last 30 Days',
            data: data,
            borderColor: 'rgba(75, 192, 192, 1)',
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderWidth: 2,
            pointBorderColor: 'rgba(75, 192, 192, 1)',
            pointBackgroundColor: 'rgba(75, 192, 192, 1)',
            pointBorderWidth: 1,
            pointRadius: 4,
            pointHoverRadius: 6,
        tension: 0.4  // Adds a curve to the line
          }]
        },
        options: {
          ...chartOptions,
          scales: {
            y: {
              beginAtZero: true,
              title: {
                display: true,
                text: 'Number of Appointments'
              }
            },
            x: {
              title: {
                display: true,
                text: 'Date'
              }
            }
          },
          plugins: {
            tooltip: {
              backgroundColor: 'rgba(0, 0, 0, 0.7)',
              titleFont: { size: 14 },
              bodyFont: { size: 12 },
              padding: 10,
              displayColors: false
            },
            legend: {
              labels: {
                font: {
                  size: 14
                }
              }
            }
          }
        }
      });
    }

  </script>
  @endpush
