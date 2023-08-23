@extends('layout')

@section('main')





<div class="text-center mb-5">
    <h1 class="fw-bolder">Edit Batch</h1>
</div>
<div class="container px-5 my-5">
    @foreach ($batches as $batch)
    <form method="POST" action="{{ route('updatebatch', ['id' => $batch->btID]) }}">
        @csrf
        @method('PUT')
        <table style="align-content: center" id="editTable">
            <tr>
                <th><label for="title">Batch #</label></th>
                <td><input pattern="[A-Za-z]{3}\d{5}" title="Please enter 3 digit hospital + 2 digit year + 3 digit sequential number" size="20" type="text" name="btNumber" value="{{$batch->btNumber}}"></td>
            </tr>
            <tr>
                <th><label for="title">Hospital: </label></th>
                <td><select name="btHospitalID" >
            
                    {{-- Stores Hospital ID in a variable to determine selected option in the dropdown --}}
                    @php
                        $selectedoption = $batch->btHospitalID;
                    @endphp
        
                    @foreach ($hospitals as $hospital)
                    {{-- Changes selected option to the corresponding Hospital Type--}}
                    <option value="{{ $hospital->hsID }}" {{ $selectedoption == $hospital->hsID ? 'selected' : '' }}>{{ $hospital->hsIMPS_ID }} - {{ $hospital->hsTitle }}</option>
                    @endforeach
                </select></td>
            </tr>
            <tr>
                <th><label for="title">Created at: </label></th>
                <td><label for="title">{{$batch->btCreatedDate}} </label></td>
            </tr>
            <tr>
                <th><label for="title">Created by: </label></th>
                <td><label for="title">{{$batch->btCreatedBy}} </label></td>
            </tr>
            <tr>
                <th><label for="title">Last Updated: </label></th>
                <td><label for="title">{{$batch->btLastUpdatedDate}} </label></td>
            </tr>
            <tr>
                <th><label for="title">Last Updated By</label></th>
                <td><label for="title">{{$batch->btLastUpdatedBy}} </label></td>
            </tr>
        </table>
        

        @endforeach
        
        <br>
        <br>
        <br>
        <div class="btnDiv">
            <button class="btn btn-primary btn-lg px-4 me-sm-3" type="submit">Save</button>
            <a class="btn btn-primary btn-lg px-4 me-sm-3" style="background-color: rgb(240, 58, 58);border-color:rgb(240, 58, 58)" href="{{ route('batches') }}">Cancel</a>
        </div>
    </form>


<div class="container px-5 my-5">
@endsection