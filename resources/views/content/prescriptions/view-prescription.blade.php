    <div class="modal fade" id="prescriptionModal" tabindex="-1" aria-labelledby="prescriptionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header d-flex align-items-center justify-content-between">
                    <h5 class="modal-title" id="prescriptionModalLabel" style="margin: auto;">Mansha's Dental Clinic</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <header>
                        <p>{{ $address }}</p>
                        <p>Phone: {{ $clinic_phone }}</p>
                    </header>

                    <div class="patient-info">
                        <p><strong>Patient Name:</strong> {{ $appointment->name }}</p>
                        <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($appointment->start_date_time)->format('F j, Y') }}</p>
                    </div>

                    <div class="prescription-details">
                        <h2>Prescription</h2>
                        <div class="table-responsive">
                        <table class="medication-table table">
                            <thead>
                                <tr>
                                    <th>Medication</th>
                                    <th>Dosage</th>
                                    <th>Duration</th>
                                    <th>Frequency</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($prescriptions as $prescription)
                                @php
                                $prescription->details = json_decode($prescription->details, true);
                                @endphp
                                <tr>
                                    <td>{{ $prescription->medicine->medicine }}</td>
                                    <td>{{ $prescription->medicine->dosage }}</td>
                                    <td>{{$prescription->details['duration'] }} {{ $prescription->details['time_unit']}}</td>
                                    <td>{{$prescription->details['daily_dosage']}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="downloadPdfButton" class="btn btn-primary">Save PDF</button>
                </div>
            </div>
        </div>
    </div>

    <style>
       {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

/* Modal Custom Styles */
.modal-content {
    border-radius: 8px;
    padding: 20px;
}

/* Modal Header */
.modal-header {
    border-bottom: 1px solid #e5e5e5;
}

.modal-title {
    font-size: 24px;
    color: #333;
}

.btn-close {
    background: none;
    border: none;
    background-repeat: no-repeat !important;
    background-position: center !important;
}

/* Clinic Header Information */
header {
    text-align: center;
    margin-bottom: 20px;
}

header p {
    font-size: 14px;
    color: #555;
}

/* Patient Information Section */
.patient-info p {
    font-size: 16px;
    color: #333;
    margin: 5px 0;
}

/* Prescription Details Section */
.prescription-details {
    margin-top: 20px;
}

.prescription-details h2 {
    font-size: 20px;
    color: #333;
    margin-bottom: 15px;
}

/* Prescription Table Styling */
.medication-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
}

.medication-table th,
.medication-table td {
    padding: 12px;
    text-align: left;
    font-size: 16px;
}

.medication-table th {
    background-color: #f4f4f4;
    font-weight: bold;
    color: #333;
    border-bottom: 2px solid #ddd;
}

.medication-table td {
    color: #555;
    border-bottom: 1px solid #e0e0e0;
}

.medication-table tbody tr:hover {
    background-color: #f1f8ff;
}

/* Modal Footer */
.modal-footer {
    border-top: 1px solid #e5e5e5;
    padding-top: 15px;
}

.modal-footer .btn {
    min-width: 100px;
}

/* Print Styling */
@media print {
    @page {
        size: A4;
        margin: 10mm;
    }

    .modal-content {
        border: none;
        box-shadow: none;
        width: 100%; /* Ensure it uses the full width */
        height: auto; /* Allow auto height for content */
    }

    header, .patient-info, .prescription-details {
        page-break-inside: avoid;
    }

    .medication-table th, .medication-table td {
        border: 1px solid #ddd;
        padding: 8px;
    }

    .modal-footer, .btn-close {
        display: none; /* Hide elements that are unnecessary for printing */
    }
}
</style>
