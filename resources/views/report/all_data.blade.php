@extends('layouts.horizontal_dashboard.app')

@push('css')
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-rowgroup-bs5/rowgroup.bootstrap5.css') }}" />
@endpush

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="py-3 mb-4"><span class="text-muted fw-light"> </span> Report Data </h4>
    <!-- DataTable with Buttons -->
    <div class="card">
        <div class="row pt-5 pb-3 px-3">
            <div class="col-md-12">
                <div class="d-flex flex-row mb-3 bg-light px-3 py-3 flex-wrap align-items-center">
                    <div class="d-flex flex-row flex-wrap align-items-center mb-3">
                        <div class="d-flex flex-row align-items-center me-2">
                            <label for="from-date" class="form-label me-2">From date</label>
                            <input type="text" class="form-control" placeholder="YYYY-MM-DD" id="from-date" />
                        </div>
                        <div class="d-flex flex-row align-items-center me-2">
                            <label for="to-date" class="form-label me-2">To date</label>
                            <input type="text" class="form-control" placeholder="YYYY-MM-DD" id="to-date" />
                        </div>
                    </div>
                    <div class="d-flex flex-row align-items-center flex-wrap mb-3">
                        <button id="filterButton" type="button" class="btn btn-primary me-2 mb-1"><i class="ti ti-filter"></i> Filter</button>
                        <button id="xlxsButton" type="button" class="btn btn-success me-2 mb-1"><i class="ti ti-file-text"></i> XLXS</button>
                        <button id="csvButton" type="button" class="btn btn-success me-2 mb-1"><i class="ti ti-file-text"></i> CSV</button>
                        <button id="pdfButton" type="button" class="btn btn-danger me-2 mb-1"><i class="ti ti-file-text"></i> PDF</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-datatable table-responsive pt-0">
            <table class="datatables-basic table data-table-all">
                <thead>
                    <tr>
                        <th>Tegangan</th>
                        <th>Arus</th>
                        <th>Daya</th>
                        <!-- <th>Daya Reaktif</th>
                        <th>Daya Semu</th>
                        <th>Frekuensi</th> -->
                        <th>Energi Listrik</th>
                        <th>Waktu</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

@endsection

@push('plugin-script')
<script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
@endpush
@push('script')
<script>
    $(function() {
        $('#filterButton').click(function() {
            table.ajax.reload();
        });
        let table = $('.data-table-all').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('list.all.data.sensor') }}",
                data: function(d) {
                    d.start_date = $('#from-date').val();
                    d.end_date = $('#to-date').val();
                }
            },
            columns: [{
                    data: 'tegangan',
                    name: 'tegangan',
                    render: function(data, type, row) {
                        return data + ' V';
                    }
                },
                {
                    data: 'arus',
                    name: 'arus',
                    render: function(data, type, row) {
                        return data + ' A';
                    }
                },
                {
                    data: 'dy_aktif',
                    name: 'dy_aktif',
                    render: function(data, type, row) {
                        return data + ' W';
                    }
                },
                // {
                //     data: 'dy_reaktif',
                //     name: 'dy_reaktif',
                //     render: function(data, type, row) {
                //         return data + ' Var';
                //     }
                // },
                // {
                //     data: 'dy_semu',
                //     name: 'dy_semu',
                //     render: function(data, type, row) {
                //         return data + ' VA';
                //     }
                // },
                // {
                //     data: 'frekuensi',
                //     name: 'frekuensi',
                //     render: function(data, type, row) {
                //         return data + ' Hz';
                //     }
                // },
                {
                    data: 'energi',
                    name: 'energi',
                    render: function(data, type, row) {
                        return data + ' kWh';
                    }
                },
                {
                    data: 'created_at',
                    name: 'created_at',
                },
            ]
        });
    });

    //export xlsx
    $('#xlxsButton').click(function() {
        let fromDate = $('#from-date').val();
        let toDate = $('#to-date').val();

        $.ajax({
            url: '{{ route("export.xlsx.all.data") }}',
            method: 'POST',
            data: {
                from_date: fromDate || null,
                to_date: toDate || null,
                _token: '{{ csrf_token() }}'
            },
            xhrFields: {
                responseType: 'blob'
            },
            success: function(response) {
                let blobUrl = URL.createObjectURL(response);
                let a = document.createElement('a');
                a.href = blobUrl;
                a.download = 'data_sensor_' + new Date().toISOString().slice(0, 10) + '.xlsx';
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
            },
            error: function(response) {
                alert('Error exporting file!');
            }
        });
    });

    $('#csvButton').click(function() {
        let fromDate = $('#from-date').val();
        let toDate = $('#to-date').val();

        $.ajax({
            url: '{{ route("export.csv.all.data") }}',
            method: 'POST',
            data: {
                from_date: fromDate || null,
                to_date: toDate || null,
                _token: '{{ csrf_token() }}'
            },
            xhrFields: {
                responseType: 'blob'
            },
            success: function(response) {
                let blobUrl = URL.createObjectURL(response);
                let a = document.createElement('a');
                a.href = blobUrl;
                a.download = 'data_sensor_' + new Date().toISOString().slice(0, 10) + '.csv';
                document.body.appendChild(a);
                a.click();
                document.body.removeChild(a);
            },
            error: function(response) {
                alert('Error exporting file!');
            }
        });
    });

    $('#pdfButton').click(function() {
        let fromDate = $('#from-date').val();
        let toDate = $('#to-date').val();

        $.ajax({
            url: '{{ route("export.pdf.all.data") }}',
            method: 'POST',
            data: {
                from_date: fromDate || null,
                to_date: toDate || null,
                _token: '{{ csrf_token() }}'
            },
            xhrFields: {
                responseType: 'blob'
            },
            success: function(response) {
                // console.log(response);
                let blob = new Blob([response], {
                    type: 'application/pdf'
                });
                let link = document.createElement('a');
                link.href = window.URL.createObjectURL(blob);
                link.download = 'data_sensor_' + new Date().toISOString().slice(0, 10) + '.pdf';
                link.click();
                window.URL.revokeObjectURL(link.href);
            },
            error: function(xhr, status, error) {
                alert('Error: ' + error.message);
            }
        });
    });
</script>
@endpush