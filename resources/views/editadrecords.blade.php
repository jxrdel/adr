@extends('layout')

@section('main')

<div class="text-center mb-5">
    <h1 class="fw-bolder">Edit Records</h1>
</div>
<div class="container px-5 my-5" style="align-content: center">
    @foreach ($records as $record)
    <form method="POST" action="{{ route('editadrecords', ['id' => $record->adID]) }}">
        @csrf
        @method('PUT')
        <table style="margin: 0 auto;">
            <tr>
                <th><label for="title">Registration Number &nbsp;</label></td>
                <td><input size="20" type="text" name="hsTitle" value="{{$record->adRegistrationNo}}"></td>
            </tr>
            <tr>
                <th><label for="title">Admission Serial No.</label></td>
                <td><input type="text" name="hsCode" value="{{$record->srTitle}}"></td>
            </tr>
            <tr>
                <th><label for="title">Residential Zone</label></td>
                <td><input type="text" name="hsCode" value="{{$record->rzTitle}}"></td>
            </tr>
            <tr>
                <th><label for="title">Marital Status</label></td>
                <td><input type="text" name="hsCode" value="{{$record->msTitle}}"></td>
            </tr>
            <tr>
                <th><label for="title">Sex</label></td>
                <td><select name="hsTypeID" >
            
                    {{-- Stores Hospital ID in a variable to determine selected option in the dropdown --}}
                    @php
                        $selectedoption = $record->sxIMPS_ID;
                    @endphp
        
                    @foreach ($sexes as $sex)
                    {{-- Changes selected option to the corresponding Hospital Type--}}
                    <option value="{{ $sex->sxIMPS_ID }}" {{ $selectedoption == $sex->sxIMPS_ID ? 'selected' : '' }}>{{ $sex->sxIMPS_ID }}: {{ $sex->sxTitle }}</option>
                    @endforeach
                </select></td>
            </tr>
            <tr>
                <th><label for="title">Date of Birth</label></td>
                <td><input type="date" name="hsCode" value="{{$record->formatted_adDateOfBirth}}"></td>
            </tr>
            <tr>
                <th><label for="title">Date of Admission</label></td>
                <td><input type="date" name="hsCode" value="{{$record->formatted_adDateOfAdmission}}"></td>
            </tr>
            <tr>
                <th><label for="title">Date of Discharge</label></td>
                <td><input type="date" name="hsCode" value="{{$record->formatted_adDateOfDischarge}}"></td>
            </tr>
            <tr>
                <td><br><button class="btn btn-primary btn-lg px-4 me-sm-3" type="submit">Save</button></td>
                <td><br><a class="btn btn-primary btn-lg px-4 me-sm-3" style="background-color: rgb(240, 58, 58);border-color:rgb(240, 58, 58)" href="{{ route('adrecords') }}">Cancel</a></td>
            </tr>
        </table>
        
        
        <br><br>
        
        @endforeach
        
        <br>
        <br>
        <br>

        
        
    </form>


<div class="container px-5 my-5">
@endsection