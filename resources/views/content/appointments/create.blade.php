@extends('layouts/contentNavbarLayout')

@section('title', 'Book An Appointment')
@section('nav-title', 'Appointments')
@section('content')
@include('content.appointments.patientAndServiceModals')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<div class="container bg-white py-5 rounded" data-aos="fade-up" data-aos-delay="100">
  <h3>Book An Appointment</h3>
  <hr>

  <form action="{{ route('appointments.store') }}" method="post" role="form" class="php-email-form">
    @csrf
    <div class="row justify-content-between">
      <div class="col-md-5 col-10 form-group">
        <select id="patient_select" name="patient_id" class="form-select select2" required="">
          <option selected disabled>Select Patient</option>
          @foreach($patients as $patient)
          <option data-phone="{{ $patient->phone }}" value="{{ $patient->id }}">
            #{{ $patient->registration_id }} | {{ $patient->name }}
          </option>
          @endforeach
        </select>
      </div>
      <div class="col-1 d-flex justify-content-end align-items-center">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#patientRegisterModal">+</button>
      </div>
      <div class="col-md-6 form-group mt-3 mt-md-0 m-auto">
        <input type="text" class="form-control bg-light" name="phone" id="phone" placeholder="Patient's Phone" required>
      </div>
    </div>

    <div class="row">
      <div class="col-md-3 form-group mt-3">
        <div class="input-group">
          <input type="text" name="date" class="form-control bg-white datepicker rounded-start" id="date" placeholder="Pick a Date" required>
          <button class="btn btn-outline-secondary" type="button" id="calendar-btn">
            <i class="fa fa-calendar"></i>
          </button>
        </div>
      </div>
      <div class="col-md-3 form-group mt-3">
        <select id="time" name="time" class="form-select" required>
          <!-- Options will be populated by JavaScript -->
        </select>
      </div>

      <div class="col-md-4 form-group mt-3 row border-end border-end-3 border-primary me-1">
        <div class="col-10">
          <select name="service_id" id="service_select" class="form-select select2" required="">
            <option selected disabled>Select Service</option>
            @foreach($services as $service)
            <option value="{{ $service->id }}">{{ $service->name }}</option>
            @endforeach
          </select>
        </div>
        <div class="col-1">
          <button type="button" class="btn btn-primary px-5" data-bs-toggle="modal" data-bs-target="#serviceRegisterModal">+</button>
        </div>
      </div>

      <div class="col m-auto form-group mt-3">
        <select name="user_id" class="form-select select2" required="">
          <option selected disabled>Select Doctor</option>
          @foreach($doctors as $doctor)
          <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
          @endforeach
        </select>
      </div>
    </div>

    <div class="form-group mt-3">
      <textarea class="form-control" name="message" rows="5" placeholder="Message (Optional)"></textarea>
    </div>
    <div class="mt-3">
      <div class="text-center"><button class="btn btn-primary rounded px-5" type="submit">Make an Appointment</button></div>
    </div>
  </form>

</div>
@endsection

@push('page-scripts')
<script>
  jQuery(document).ready(function($) {
    $('.select2').select2({
      width: '100%',
    });
    $('#select2').select2({
      width: '100%',
      dropdownParent: $('#patientRegisterModal')
    });
  });
  document.addEventListener('DOMContentLoaded', () => {
    const timeSelect = document.getElementById('time');
    const datePicker = document.getElementById('date');

  // Initialize Flatpickr with a callback on date change
    flatpickr(datePicker, {
      dateFormat: 'F j, Y',
      altInput: true,
      altFormat: 'F j, Y',
      minDate: 'today',
      onChange: function(selectedDates, dateStr, instance) {
      // Fetch booked hours for the selected date
        fetchBookedHours(dateStr);
      }
    });
    document.getElementById('calendar-btn').addEventListener('click', function() {
  // Open the calendar if it isn't already open
      datePicker._flatpickr.open();
    });

    function formatTimeTo12Hour(hours) {
      const period = hours >= 12 ? 'PM' : 'AM';
    hours = hours % 12 || 12; // Convert to 12-hour format
      return `${hours} ${period}`;
    }

    function generateTimeOptions(bookedHours = []) {
      timeSelect.innerHTML = '';
      for (let hours = parseInt({{ $start_time }}); hours <= parseInt({{ $end_time }}); hours++) {
        const value = `${('0' + hours).slice(-2)}:00`;
        let text = formatTimeTo12Hour(hours);
        if (bookedHours.includes(hours)) {
          text += ' (Unavailable)';
        }
        const option = new Option(text, value);
        if (bookedHours.includes(hours)) {
          option.disabled = true;
        }
        timeSelect.add(option);
      }
    }


    function fetchBookedHours(date) {
      fetch(`{{ route('appointments.bookedHours') }}?date=${date}`)
      .then(response => response.json())
      .then(bookedHours => {
        // Pass bookedHours to generateTimeOptions to disable those times
        generateTimeOptions(bookedHours);
      })
      .catch(error => console.error('Error fetching booked hours:', error));
    }

  // Initial time options generation on page load
    generateTimeOptions();
  });


  $('#patient_select').on('change', function(){
   var selectedOption = $(this).find('option:selected');
   $('#phone').val(selectedOption.data('phone'))
 });
</script>
@endpush
