@extends('layouts/contentNavbarLayout')
@section('title', 'Edit Prescription')
@section('content')
@include('content.prescriptions.view-prescription')
<style type="text/css">
    td,
    th {
        width: 20% !important;
    }

</style>
<div class="container card p-5">
    <div class="d-flex justify-content-between align-items-center">
        <h3>Edit Prescription</h3>
        <a href="#" class="btn btn-primary me-2 view-modal" data-bs-toggle="modal" data-bs-target="#prescriptionModal">View</a>
    </div>
    <hr>
    <div class="d-flex justify-content-around align-items-center mb-3">
        <label>Appointment For</label />
        <input class="text-center p-2 border rounded" value="{{ $appointment->name }}" readonly>
        <label>Appointment Date</label>
        <input class="text-center p-2 border rounded" value="{{ $appointment->start_date_time }}" readonly>
    </div>
    <form method="post" action="{{route('prescription.update')}}">
        @csrf
        <input type="hidden" name="appointment_id" value="{{ $appointment->id }}">
        <div class="table-responsive">
            <table class="table" id="prescriptionTable">
                <thead>
                    <tr>
                        <th>Medicine</th>
                        <th>Duration</th>
                        <th></th>
                        <th>Frequency</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($prescriptions as $prescription)
                    {{-- @php
                    $prescription->details = json_decode($prescription->details, true);
                    @endphp --}}
                    <tr>
                        <td>
                            <select class="form-control select2" name="medicine[]">
                                <option selected disabled>Select Medicine</option>
                                @foreach($medicine as $m)
                                <option @if($prescription->medicine_id == $m->id) selected @endif value="{{ $m->id }}">{{ $m->medicine }} - {{ $m->dosage }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td><input type="number" class="form-control" value="{{ (int)$prescription->details['duration'] ?? 0 }}" name="duration[]" placeholder="Duration"></td>
                        <td>
                            <select class="form-control form-select" name="time_unit[]">
                                <option @if($prescription->details['time_unit'] == 'days') selected @endif value="days">Days</option>
                                <option @if($prescription->details['time_unit'] == 'weeks') selected @endif value="weeks">Weeks</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-control form-select" name="daily_dosage[]">
                                <option selected disabled>Select</option>
                                <option @if($prescription->details['daily_dosage'] == '1 Time a Day') selected @endif value="1 Time a Day">1 Time a Day</option>
                                <option @if($prescription->details['daily_dosage'] == '2 Times a Day') selected @endif value="2 Times a Day">2 Times a Day</option>
                                <option @if($prescription->details['daily_dosage'] == '3 Times a Day') selected @endif value="3 Times a Day">3 Times a Day</option>
                            </select>
                        </td>
                        <td class="d-flex">
                            <button type="button" class="btn btn-primary add-row  me-2">+</button>
                            <button type="button" class="btn btn-dark remove-row " disabled>-</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <input type="submit" value="Save" class="btn btn-primary form-control">
    </form>
</div>
@endsection
@push('page-scripts')
<script>
    
    jQuery(document).ready(function ($) {
        @if($status)
        var modal = new bootstrap.Modal(document.getElementById('prescriptionModal'));
        modal.show();
        @endif
        $('.select2').select2({
            width: '100%',
        });

        function updateRemoveButtonState() {
            const rowCount = $('#prescriptionTable tbody tr').length;
            $('.remove-row').prop('disabled', rowCount <= 1);
        }

        $(document).on('click', '.add-row', function () {
            const newRow = `<tr>
                <td>
                    <select class="form-control select2" name="medicine[]">
                        <option selected disabled>Select Medicine</option>
                        @foreach($medicine as $m)
                        <option value="{{ $m->id }}">{{ $m->medicine }}</option>
                        @endforeach
                    </select>
                </td>
                <td><input type="text" class="form-control" name="duration[]" placeholder="Duration"></td>
                <td>
                    <select class="form-control" name="time_unit[]">
                        <option value="days">Days</option>
                        <option value="weeks">Weeks</option>
                    </select>
                </td>
                <td><select class="form-control form-select" name="daily_dosage[]">
                    <option selected disabled>Select</option>
                    <option value="days">1 Time a Day</option>
                    <option value="weeks">2 Times a Day</option>
                    <option value="weeks">3 Times a Day</option>
                </select></td>
                <td>
                    <button type="button" class="btn btn-primary add-row me-2">+</button>
                    <button type="button" class="btn btn-dark remove-row">-</button>
                </td>
            </tr>`;

            $('#prescriptionTable tbody').append(newRow);
            $('.select2').select2({
                width: '100%' // Ensuring that the new dropdown takes full width
            });
            updateRemoveButtonState();
        });

        $(document).on('click', '.remove-row', function () {
            $(this).closest('tr').remove();
            updateRemoveButtonState();
        });

        updateRemoveButtonState();
    });

        $('#downloadPdfButton').click(function() {
            var modal = bootstrap.Modal.getInstance(document.getElementById('prescriptionModal'));
            modal.hide();
            Swal.fire({
                title: 'Loading...',
                text: 'Generating your PDF, please wait.',
                allowOutsideClick: false,
                showConfirmButton: false,
                onBeforeOpen: () => {
                    Swal.showLoading()
                },
            });
            $.ajax({
                url: '{{ route('prescription.download', ['id'=>$appointment->id])}}',
                method: 'GET',
                success: function(response) {
                    const blob = new Blob([data], { type: 'application/pdf' });
                    const link = document.createElement('a');
                    link.href = window.URL.createObjectURL(blob);
                    link.download = 'document.pdf';
                    document.body.appendChild(link);
                    link.click();
                    setTimeout(() => {
                        document.body.removeChild(link);
                        window.URL.revokeObjectURL(link.href);
                    }, 100);
                },
                complete: function () {
                   Swal.close();
               }
           });
        });
</script>
@endpush
