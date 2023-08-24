@extends('layout')

@section('main')
<div class="text-center mb-5">
    <h1 class="fw-bolder">Batch Records</h1>
</div>
<div class="container px 6 my 6">
<table id="recordsTable" class="table table-striped table-bordered hover" width="100%">
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
            <th>Edit</th>
            <th>View Records</th>
            <th>Add Records</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($batches as $batch)
        <tr>
            <td>{{ $batch->btNumber }}</td>
            <td>{{ $batch->hsCode }}</td>
            <td>{{ $batch->hsTitle }}</td>
            <td>{{ $batch->btCreatedDate}}</td>
            <td>{{ $batch->btCreatedBy }}</td>
            <td>{{ $batch->btLastUpdatedDate }}</td>
            <td>{{ $batch->btLastUpdatedBy }}</td>
            <td>{{ $batch->batch_count }}</td>
            <td><a style="display:flex; justify-content: center; align-items: center;" class="fs-5 px-2 link-dark" href="{{ route('editbatch', ['id' => $batch->btID]) }}"><i class="bi bi-pencil-square"></i></a></td>
            <td><a style="display:flex; justify-content: center; align-items: center;" class="fs-5 px-2 link-dark" href="{{ route('viewbatchrecords', ['id' => $batch->btID]) }}"><i class="bi bi-list-check"></i></a></td>
            <td><a style="display:flex; justify-content: center; align-items: center;" class="fs-5 px-2 link-dark" href="{{ route('createbatchrecord', ['id' => $batch->btID]) }}"><i class="bi bi-file-earmark-plus"></i></a></td>
        </tr>
        @endforeach
    </tbody>
</table>

</div>

<div class="container px-5 my-5">
@endsection