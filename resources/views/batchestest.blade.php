@extends('layout')

@section('main')
<div class="text-center mb-5">
    <h1 class="fw-bolder">Batch Records</h1>
</div>
<div class="container px 6 my 6">
<table id="batchrecordsTable" class="table table-striped table-bordered hover" width="100%">
    <thead>
        <tr>
            <th>Batch #</th>
            <th>Hospital Code</th>
            <th>Hospital</th>
            <th>Create Date</th>
            <th>Created by</th>
            <th>Last Updated</th>
            <th>Last Updated By</th>
            <th># Records</th>
            <th>Edit Batch</th>
            <th>View Records</th>
            <th>Add Records</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>

</div>

@endsection