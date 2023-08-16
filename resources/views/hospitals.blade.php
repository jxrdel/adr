@extends('layout')

@section('main')
<div class="text-center mb-5">
    <h1 class="fw-bolder">Hospitals</h1>
</div>
<div class="container px-5 my-5">
<table id="myTable" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Hospital Title</th>
            <th>Hospital Code</th>
            <th>Hospital Type</th>
            <th>Edit</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($hospitals as $hospital)
        <tr>
            <td>{{ $hospital->hsTitle }}</td>
            <td>{{ $hospital->hsCode }}</td>
            <td>{{ $hospital->htTitle }}</td>
            <td><a style="display:flex; justify-content: center; align-items: center;" class="fs-5 px-2 link-dark" href="{{ route('edithospitals', ['id' => $hospital->hsID]) }}"><i class="bi bi-pencil-square"></i></a></td>
        </tr>
        @endforeach
    </tbody>
</table>

</div>

<div class="container px-5 my-5">
@endsection