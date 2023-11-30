@extends('layout')

@section('main')
<div class="text-center mb-5">
    <h1 class="fw-bolder">Admission & Discharge Records</h1>
</div>
@php
    //Get current year
    $currentYear = date('Y');

    //Get amount of pages based on amount of records for the given year. Each page has 5000 records
    $remainder = $recordCount % 5000;
        if ($remainder >= 1){
            $pages = (intval($recordCount / 5000) + 1);
        }else{
            $pages = intval($recordCount / 5000) ;
        }
@endphp
<div class="container">
    {{-- Dropdown to select year --}}
    <div style="display:flex;justify-content:center;align-items:center">
    <select name="yearSelect" id="yearSelect" style="border-radius: 6px;font-size: large;font-weight: bold;">
        @for ($years = $currentYear; $years >= 2007; $years--)
            <option value="{{$years}}" {{ $years == $year ? 'selected' : '' }}><a href="">{{$years}}</a></option>
        @endfor
    </select>
    &nbsp; 
    &nbsp; 
    

    </div>
    <br>

    {{-- Pagination --}}
    <div style="display:flex;justify-content:center;align-items:center">
        @if ($page > 1)
    
        <a class="btn btn-primary btn-lg px-4 me-sm-3"  href="{{ route('records', ['year' => $year, 'page' => $page - 1]) }}">< </a>
        
    @endif

    <p style="font-size: medium;font-weight: bold;">&nbsp; Page {{$page}} of {{$pages}} &nbsp; &nbsp;</p>

    @if ($page < $pages)

        <a class="btn btn-primary btn-lg px-4 me-sm-3" style="margin-right: 0px"  href="{{ route('records', ['year' => $year, 'page' => $page + 1]) }}"> ></a>
        
    @endif
    <br>
    
    </div>
    <br>

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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Listen for changes in the dropdown
        $('#yearSelect').change(function() {
            var selectedRoute = $(this).val();

            // Check if a valid option is selected
            if (selectedRoute) {
                // Redirect to the route for the year selected
                window.location.href = '{{ url('/records') }}/' + selectedRoute + '/page/' + 1 ;
            }
        });
    });
</script>

@endsection