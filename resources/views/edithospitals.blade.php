@extends('layout')

@section('main')





<div class="text-center mb-5">
    <h1 class="fw-bolder">Edit Hospitals</h1>
</div>
<div class="container px-5 my-5" style="align-content: center">
    @foreach ($hospitals as $hospital)
    <form method="POST" action="{{ route('updatehospitals', ['id' => $hospital->hsID]) }}">
        @csrf
        @method('PUT')
        
        <label for="title">Hospital Title</label>
        <input size="40" type="text" name="hsTitle" value="{{$hospital->hsTitle}}">
        <br><br>
        <label for="title">Hospital Code</label>
        <input type="text" name="hsCode" value="{{$hospital->hsCode}}">
        <br><br>
        <label for="title">Hospital Type</label>

        
        <select name="hsTypeID" >
            
            {{-- Stores Hospital ID in a variable to determine selected option in the dropdown --}}
            @php
                $selectedoption = $hospital->htID;
            @endphp

            @foreach ($hTypes as $hType)
            {{-- Changes selected option to the corresponding Hospital Type--}}
            <option value="{{ $hType->htID }}" {{ $selectedoption == $hType->htID ? 'selected' : '' }}>{{ $hType->htTitle }}</option>
            @endforeach
        </select>

        @endforeach
        
        <br>
        <br>
        <br>

        <button class="btn btn-primary btn-lg px-4 me-sm-3" type="submit">Save</button>
        <a class="btn btn-primary btn-lg px-4 me-sm-3" style="background-color: rgb(240, 58, 58);border-color:rgb(240, 58, 58)" href="{{ route('hospitals') }}">Cancel</a>
    </form>


<div class="container px-5 my-5">
@endsection