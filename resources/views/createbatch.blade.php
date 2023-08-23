@extends('layout')

@section('main')





<div class="text-center mb-5">
    <h1 class="fw-bolder">Insert Batch</h1>
</div>
<div class="container px-5 my-5">
    <form method="POST" action="{{ route('insertbatch') }}">
        @csrf
        @method('PUT')
        <table style="align-content: center" id="editTable">
            <tr>
                <th><label for="title">Batch #</label></th>
                <td><input pattern="[A-Za-z]{3}\d{5}" title="Please enter 3 digit hospital + 2 digit year + 3 digit sequential number" size="20" type="text" name="btNumber" ></td>
            </tr>
            <tr>
                <th><label for="title">Hospital: </label></th>
                <td><select name="btHospitalID" >
        
                    @foreach ($hospitals as $hospital)
                    {{-- Changes selected option to the corresponding Hospital Type--}}
                    <option value="{{ $hospital->hsID }}" >{{ $hospital->hsIMPS_ID }} - {{ $hospital->hsTitle }}</option>
                    @endforeach
                </select></td>
            </tr>
            
        </table>
        

        
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