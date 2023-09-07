@extends('layout')

@section('main')
<section class="bg-light py-5">
    <div class="text-center mb-5">
        <h1 class="fw-bolder">Admission and Discharge Records Centre</h1>
    </div>
    <div class="container px-5 my-5">
        <div class="row gx-5 justify-content-center">

            <!-- Create Batches-->
            <div class="col-lg-6 col-xl-4">
                <div class="card mb-5 mb-xl-0" style="min-height: 490px">
                    <div class="card-body p-5">
                        <div class="mb-3">
                            <h1 style="text-align: center">Create a New Batch</h1>
                            <br>
                            <p>This will represent a new batch that comes from a hospital containing records.</p>
                            <p>Once the new batch has been created, you will be able to enter its corresponding records.</p>
                                <br>
                        </div>
                        <div class="d-grid"><a class="btn btn-outline-primary" href="{{ route('createbatch') }}"> <i class="bi bi-file-earmark-plus"></i> Create a Batch</a></div>
                    </div>
                </div>
            </div>
            
            <!-- View Batches-->
            <div class="col-lg-6 col-xl-4">
                <div class="card mb-5 mb-xl-0" style="min-height: 490px">
                    <div class="card-body p-5">
                        <div class="mb-3">
                            <h1 style="text-align: center">View Batches</h1>
                            <br>
                            <p>Click below to view and search for existing batches within the system.  Batches contain admission and discharge records.</p>
                            <p>Each batch comes from a hospital and contains approximately 250 records. You can search for batches by entering the batch number, hospital code or hospital title.</p>
                            
                        </div>
                        <div class="d-grid" style="padding-top: 20px"><a class="btn btn-outline-primary" href="{{ route('batches') }}"> <i class="bi bi-search"></i> View Batches</a></div>
                    </div>
                </div>
            </div>

            
            
            <!-- View Records-->
            <div class="col-lg-6 col-xl-4" >
                <div class="card mb-5 mb-xl-0" style="min-height: 490px">
                    <div class="card-body p-5" >
                        <div class="mb-3">
                            <h1 style="text-align: center">View Records</h1>
                            <br>
                            <p>Click here to view and search for existing records within the system.  Use this tool to locate records in order to correct 
                                data-entry errors or simply to reference a particular record.</p>
                            <p> You can search for records by entering the patient's registration number, 
                                the parent batch or the hospital.</p>
                                <br>
                        </div>
                        <div class="d-grid"><a class="btn btn-outline-primary" href="{{ route('adrecords') }}"> <i class="bi bi-card-list"></i></i></i> View Records</a></div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</section>
@endsection