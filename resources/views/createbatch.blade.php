@extends('layout')

@section('main')





<div class="text-center mb-5">
    <h1 class="fw-bolder">Create Batch</h1>

    @if($errors->has('btNumber'))
    <span class="text-danger">Batch number already exists. Please enter unique Batch Number</span>
    @endif

</div>
<div class="container px-5 my-5" style="">
    <div class="batchContainer">
    <form method="POST" action="{{ route('insertbatch') }}">
        @csrf
        @method('PUT')
        <table style="align-content: center" id="editTable">
            <tr>
                {{-- Hidden row for user name --}}
                <td style="display: none"><input size="6" type="text" name="username" value="{{$_SERVER['AUTH_USER']}}"></td>
                <th><label for="title">Batch #</label></th>
                <td><input required pattern="[A-Za-z]{3}\d{5}" title="Please enter 3 digit hospital + 2 digit year + 3 digit sequential number" size="20" type="text" name="btNumber" ></td>
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
            <a class="btn btn-primary btn-lg px-4 me-sm-3" style="background-color: rgb(240, 58, 58);border-color:rgb(240, 58, 58)" href="{{ route('/') }}">Cancel</a>
        </div>
    </form>

</div>

<div class="container px-5 my-5">
@endsection