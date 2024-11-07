@extends('layouts/contentNavbarLayout')

@section('title', 'Create Prescription')

@section('content')
<style type="text/css">
    td, th{
        width:20%!important;
    }
</style>
<div class="container card p-5">
    <div class="d-flex justify-content-between align-items-center">
        <h3>Create Prescription</h3>
    </div>
    <hr>
    <div class="d-flex justify-content-around align-items-center mb-3">
        <label>Appointment For</label/>
        <input class="text-center p-2 border rounded" value="{{ $appointment->name }}" readonly>
        <label>Appointment Date</label>
        <input class="text-center p-2 border rounded" value="{{ $appointment->start_date_time }}" readonly>
    </div>
    <form method="post" action="{{route('prescription.store')}}">
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
                    <tr>
                        <td>
                            <select class="form-control select2" name="medicine[]">
                                <option selected disabled>Select Medicine</option>
                                @foreach($medicine as $m)
                                <option value="{{ $m->id }}">{{ $m->medicine }}- {{ $m->dosage }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td><input type="number" class="form-control" name="duration[]" placeholder="10"></td>
                        <td>
                            <select class="form-control form-select" name="time_unit[]">
                                <option value="days">Days</option>
                                <option value="weeks">Weeks</option>
                            </select>
                        </td>
                        <td>
                            <select class="form-control form-select" name="daily_dosage[]">
                                <option selected disabled>Select</option>
                                <option value="1">1</option>
                                <option value="1 + 1">1 + 1</option>
                                <option value="1 + 1 + 1">1 + 1 + 1</option>
                            </select>
                        </td>
                        <td class="d-flex">
                            <button type="button" class="btn btn-primary add-row  me-2">+</button>
                            <button type="button" class="btn btn-dark remove-row " disabled>-</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <input type="submit" value="Save and Preview" class="btn btn-primary form-control">
    </form>
</div>
@endsection

@push('page-scripts')
<script>

    jQuery(document).ready(function($) {
        $('.select2').select2({
            width: '100%',
        });

        function updateRemoveButtonState() {
            const rowCount = $('#prescriptionTable tbody tr').length;
            $('.remove-row').prop('disabled', rowCount <= 1);
        }

        $(document).on('click', '.add-row', function() {
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
                    <option value="1">1</option>
                    <option value="1 + 1">1 + 1</option>
                    <option value="1 + 1 + 1">1 + 1 + 1</option>
                </select></td>
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

        $(document).on('click', '.remove-row', function() {
            $(this).closest('tr').remove();
            updateRemoveButtonState();
        });

        updateRemoveButtonState();
    });

</script>
@endpush