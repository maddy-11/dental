    <style>
        #historyModal .modal-header {
            background: linear-gradient(135deg, #4e54c8, #8f94fb); /* New color gradient */
            border: none;
            color: #fff;
            border-top-left-radius: 20px; /* Rounded corners for the header */
            border-top-right-radius: 20px; /* Rounded corners for the header */
        }

        #historyModal .modal-title {
            font-weight: 700; /* Bolder title */
            font-size: 1.5rem; /* Adjusted title size */
            letter-spacing: 1px; /* Spacing for premium feel */
        }

        #historyModal .modal-content {
            border-radius: 20px; /* Increased rounded corners */
            overflow: hidden; /* Ensures no overflow */
            border: none; /* No border for a cleaner look */
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2); /* Deeper shadow for depth */
            animation: scaleIn 0.5s ease-out; /* Animation for scaling */
        }

        @keyframes scaleIn {
            from {
                transform: scale(0.8);
                opacity: 0;
            }

            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        #historyModal .modal-body {
            background-color: #fff; /* White body color */
            padding: 40px; /* More padding for spaciousness */
            color: #333; /* Darker text for better readability */
        }

        #historyModal table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        #historyModal th,
        #historyModal td {
            padding: 15px; /* Increased padding */
            border: 1px solid #ddd; /* Light gray border */
            text-align: left;
        }

        #historyModal th {
            background-color: #4e54c8; /* Header background */
            color: white; /* Header text color */
            font-weight: 600; /* Bold header text */
            text-transform: uppercase; /* Uppercase text */
        }

        #historyModal tr {
            transition: background-color 0.3s, transform 0.3s; /* Smooth transition effects */
        }

        #historyModal tr:hover {
            background-color: #f1f1f1; /* Row hover effect */
            transform: scale(1.02); /* Slightly enlarge on hover */
        }

        #historyModal .close {
            color: white; /* Close button color */
            opacity: 0.7; /* Close button opacity */
            font-size: 1.5rem; /* Larger close button */
        }

        #historyModal .close:hover {
            opacity: 1; /* Fully opaque on hover */
        }
    </style>
</head>
<body>

    <div class="container mt-5 text-center">
        <!-- The Modal -->
        <div class="modal fade" id="historyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-white" id="exampleModalLabel">Patient History</h5>
                        <button type="button" class="btn close ms-auto" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body table-responsive">
                        <table id="#historyTable" class="table datatable">
                            <thead>
                                <th>Patient</th>
                                <th>Doctor</th>
                                <th>DateTime</th>
                                <th>Procedure</th>
                                <th>Amount</th>
                            </thead>
                            <tbody id="tbody">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $('#historyModal').modal({show: false});

            $('.close').click(function(){
                $('#historyModal').modal('hide');
            });

            $('.historyModalBtn').click(function() {
                $('#historyModal').modal('show');
                let patient_id = $(this).data('patient_id');

                $.ajax({
                    url: "{{ route('examination.index.ajax') }}",
                    method: "GET",
                    data:{'patient_id': patient_id},
                    success: function(data) {
                        var tbody = $('#tbody');
                        tbody.empty()
                        $.each(data, function(index, examination) {
                            var row = '<tr>' +
                            '<td>' + examination.patient.name + '</td>' +
                            '<td>' + examination.doctor.name + '</td>' +
                            '<td>' + examination.appointment.start_date_time + '</td>' +
                            '<td>' + examination.service.name + '</td>' +
                            '<td>' + examination.price + '</td>' +
                            '</tr>';
                            tbody.append(row);
                            console.log(row)
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error("Error fetching data:", error);
                    }
                });
            });
        });
    </script>
