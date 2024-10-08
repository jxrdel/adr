@extends('layout')

@section('main')
<div class="text-center mb-5">
    <h1 class="fw-bolder">Admission & Discharge Records</h1>
</div>
<div class="container">
<table id="adrecordsTable" class="table table-striped table-bordered hover">
    <thead>
        <tr>
            <th>Registraion Number</th>
            <th>Batch ID</th>
            <th>Hospital</th>
            <th>Create By</th>
            <th>Created Date</th>
            <th>Last Updated</th>
            <th>Last Updated By</th>
            <th>Edit</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($records as $record)
        <tr>
            <td>{{ $record->adRegistrationNo }}</td>
            <td>{{ $record->btNumber }}</td>
            <td>{{ $record->hsTitle }}</td>
            <td>{{ $record->adCreatedBy }}</td>
            <td>{{ $record->adCreatedDate }}</td>
            <td>{{ $record->adLastUpdatedDate }}</td>
            <td>{{ $record->adLastUpdatedBy }}</td>
            <td><a style="display:flex; justify-content: center; align-items: center;" class="fs-5 px-2 link-dark" href="{{ route('editadrecords', ['id' => $record->adID]) }}"><i class="bi bi-pencil-square"></i></a></td>
        </tr>
        @endforeach
    </tbody>
</table>

</div>

<div class="container px-5 my-5">
@endsection