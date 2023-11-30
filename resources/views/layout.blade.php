<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Admission and Discharge Record View</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
        {{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4-4.1.1/jq-3.3.1/dt-1.10.18/sl-1.2.6/datatables.min.css"/> --}}
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{ asset('styles.css') }}" rel="stylesheet" />
    </head>
    <body class="d-flex flex-column">
        @php
            $thisYear = \Carbon\Carbon::now()->format('Y');
        @endphp
        <main class="flex-shrink-0">
            <!-- Navigation-->
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="container px-5">
                    <a class="navbar-brand" href="{{ route('/') }}">Admission and Discharge Record View</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                            <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
                            <li class="nav-item"><a class="nav-link" href="http://00-hv-dbs-01/Reports/browse/ADT%20Reports">Reports</a></li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" id="navbarDropdownBlog" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Data Entry</a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownBlog">
                                    <li><a class="dropdown-item" href="{{ route('records', ['year' => $thisYear, 'page' => 1]) }}">View Records</a></li>
                                    <li><a class="dropdown-item" href="{{ route('batches') }}">View Batches</a></li>
                                    <li><a class="dropdown-item" href="{{ route('createbatch') }}">Create Batch</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            
            <section class="bg-light py-5" style="min-height: 830px">
                @yield('main')
                
                
                    
            </section>
        </main>
        <!-- Footer-->
        <footer class="bg-dark py-4 mt-auto">
            <div class="container px-5">
                <div class="row align-items-center justify-content-between flex-column flex-sm-row">
                    <div class="col-auto"><div class="small m-0 text-white">Logged in as {{$_SERVER['AUTH_USER']}}</div></div>
                </div>
            </div>
        </footer>
        @yield('scripts')
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script>
            // DataTables configuration
            $(document).ready(function() {
                $('#myTable').DataTable();
            });

            $(document).ready(function() {
                $('#recordsTable').DataTable({
                "pageLength": 50
                });
            });

            $(document).ready(function() {
                $('#adrecordsTable').DataTable({
                "pageLength": 50,
                order: [[5, 'desc']]
                });
            });

            $(document).ready(function() {
                $('#batchTable').DataTable({
                "pageLength": 50,
                order: [[5, 'desc']]
                });
            });

            $(document).ready(function() {
            $('#userTable').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "fetchrecords.php", 
                    "type": "POST"
                },
                "columns": [
                    { "data": "adRegistrationNo" },
                    { "data": "btID" },
                    { "data": "hsTitle" },
                    { "data": "adCreatedBy" },
                    { "data": "adCreatedDate" },
                    { "data": "adLastUpdatedDate" },
                    { "data": "adLastUpdatedBy" },
                    { "data": "adLastUpdatedBy" }
                ]
            });
        });


        </script>
		
<script>
    // Initialize DataTable
    $(document).ready(function() {
            $('#batchrecordsTable').DataTable({
                "pageLength": 50,
                order: [[5, 'desc']],
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "{{ route('getbatches') }}", 
                    "type": "GET"
                },
                "columns": [
                        { data: 'btNumber', name: 'btNumber' },
                        { data: 'hsCode', name: 'adHospitals.hsCode' },
                        { data: 'hsTitle', name: 'adHospitals.hsTitle' },
                        { data: 'btCreatedDate', name: 'btCreatedDate' },
                        { data: 'btCreatedBy', name: 'btCreatedBy' },
                        { data: 'btLastUpdatedDate', name: 'btLastUpdatedDate' },
                        { data: 'btLastUpdatedBy', name: 'btLastUpdatedBy' },
                        // { data: 'batch_count', name: 'batch_count', searchable: false},
                        {
                            data: null,
                            orderable: false,
                            searchable: false,
                            render: function (data, type, row) {
                                if(data.batch_count >= 250){
                                    return '<p style = "color:red">' + data.batch_count + '</p>';
                                }else{
                                    return '<p>' + data.batch_count + '</p>';
                                }
                            }
                        },
                        {
                            data: null,
                            orderable: false,
                            searchable: false,
                            render: function (data, type, row) {
                                return '<a style="display:flex; justify-content: center; align-items: center;" class="fs-5 px-2 link-dark" href="/editbatch/' + data.btID + '"><i class="bi bi-pencil-square"></i></a>';
                            }
                        },
                        {
                            data: null,
                            orderable: false,
                            searchable: false,
                            render: function (data, type, row) {
                                return '<a style="display:flex; justify-content: center; align-items: center;" class="fs-5 px-2 link-dark" href="/viewbatchrecords/' + data.btID + '"><i class="bi bi-list-check"></i></a>';
                            }
                        },
                        {
                            data: null,
                            orderable: false,
                            searchable: false,
                            render: function (data, type, row) {
                                if(data.batch_count >= 250){
                                    return '<a style="display:flex; justify-content: center; align-items: center;" class="fs-5 px-2 link-dark"> <i title="This batch has reached the maximum number of records" style="color: red" class="bi bi-x-circle"></i></a>';
                                }else{
                                    return '<a style="display:flex; justify-content: center; align-items: center;" class="fs-5 px-2 link-dark" href="/createbatchrecord/' + data.btID + '"><i class="bi bi-file-earmark-plus"></i></a>';
                                }
                            }
                        }
                ]
            });
        });
    

</script>
    </body>
</html>