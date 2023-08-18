@extends('layout')

@section('main')

<div class="text-center mb-5">
    <h1 class="fw-bolder">Edit Record</h1>
</div>
<div class="container" >
    @foreach ($records as $record)
    <div class="clearfix" >
        <div class="table-container" style="margin-left: 150px">
            <form method="POST" action="{{ route('updateadrecords', ['id' => $record->adID]) }}">
                @csrf
                @method('PUT')
                
                <table>
                    <tr>
                        <th><label for="title">Registration Number &nbsp;</label></th>
                        <td><input pattern="[0-9]*" size="20" type="text" name="adRegistrationNo" value="{{$record->adRegistrationNo}}"></td>
                    </tr>
                    <tr>
                        <th><label for="title">Admission Serial No.</label></th>
                        <td><select name="adSerialID" >
                    
                            {{-- Stores Hospital ID in a variable to determine selected option in the dropdown --}}
                            @php
                                $selectedserial = $record->srID;
                            @endphp
                
                            @foreach ($serials as $serial)
                            {{-- Changes selected option to the corresponding Hospital Type--}}
                            <option value="{{ $serial->srID }}" {{ $selectedserial == $serial->srID ? 'selected' : '' }}>{{ $serial->srID }}: {{ $serial->srTitle }}</option>
                            @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="title">Residential Zone</label></th>
                        <td><select name="adAddress_ZoneID" >
                    
                            {{-- Stores Hospital ID in a variable to determine selected option in the dropdown --}}
                            @php
                                $selectedrz = $record->rzID;
                            @endphp
                
                            @foreach ($rzones as $rzone)
                            {{-- Changes selected option to the corresponding Hospital Type--}}
                            <option value="{{ $rzone->rzID }}" {{ $selectedrz == $rzone->rzID ? 'selected' : '' }}>{{ $rzone->rzIMPS_ID }}: {{ $rzone->rzTitle }}</option>
                            @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="title">Marital Status</label></th>
                        <td><select name="adMaritalStatusID" >
                    
                            {{-- Stores Hospital ID in a variable to determine selected option in the dropdown --}}
                            @php
                                $selectedMS = $record->msID;
                            @endphp
                
                            @foreach ($mstatuses as $mstatus)
                            {{-- Changes selected option to the corresponding Hospital Type--}}
                            <option value="{{ $mstatus->msID }}" {{ $selectedMS == $mstatus->msID ? 'selected' : '' }}>{{ $mstatus->msID }}: {{ $mstatus->msTitle }}</option>
                            @endforeach
                            </select>
                            </td>
                    </tr>
                    <tr>
                        <th><label for="title">Sex</label></th>
                        <td><select name="adSexID" >
                    
                            {{-- Stores Hospital ID in a variable to determine selected option in the dropdown --}}
                            @php
                                $selectedsex = $record->sxIMPS_ID;
                            @endphp
                
                            @foreach ($sexes as $sex)
                            {{-- Changes selected option to the corresponding Hospital Type--}}
                            <option value="{{ $sex->sxIMPS_ID }}" {{ $selectedsex == $sex->sxIMPS_ID ? 'selected' : '' }}>{{ $sex->sxIMPS_ID }}: {{ $sex->sxTitle }}</option>
                            @endforeach
                        </select></td>
                    </tr>
                    <tr>
                        <th><label for="title">Ethnicity</label></th>
                        <td><select name="adEthnicityID" >
                    
                            {{-- Stores Hospital ID in a variable to determine selected option in the dropdown --}}
                            @php
                                $selectedETH = $record->adEthnicityID;
                            @endphp
                
                            @foreach ($ethnicities as $ethnicity)
                            {{-- Changes selected option to the corresponding Hospital Type--}}
                            <option value="{{ $ethnicity->etID }}" {{ $selectedETH == $ethnicity->etID ? 'selected' : '' }}>{{ $ethnicity->etIMPS_ID }}: {{ $ethnicity->etTitle }}</option>
                            @endforeach
                        </select></td>
                    </tr>
                    <tr>
                        <th><label for="title">Date of Birth</label></th>
                        <td><input type="date" name="adDateOfBirth" value="{{$record->formatted_adDateOfBirth}}"></td>
                    </tr>
                    <tr>
                        <th><label for="title">Date of Admission</label></th>
                        <td><input type="date" name="adDateOfAdmission" value="{{$record->formatted_adDateOfAdmission}}"></td>
                    </tr>
                    <tr>
                        <th><label for="title">Date of Discharge</label></th>
                        <td><input type="date" name="adDateOfDischarge" value="{{$record->formatted_adDateOfDischarge}}"></td>
                    </tr>
                    <tr>
                        <th><label for="title">Department &nbsp;</label></th>
                        <td><select name="adDepartmentID" >
                    
                            {{-- Stores Hospital ID in a variable to determine selected option in the dropdown --}}
                            @php
                                $selectedDPT = $record->adDepartmentID;
                            @endphp
                
                            @foreach ($departments as $department)
                            {{-- Changes selected option to the corresponding Hospital Type--}}
                            <option value="{{ $department->dpID }}" {{ $selectedDPT == $department->dpID ? 'selected' : '' }}>{{ $department->dpIMPS_ID }}: {{ $department->dpTitle }}</option>
                            @endforeach
                        </select></td>
                    </tr>
                </table>
                
                    </div>
                    
                    <div class="table-container">
                        <table>
                            <tr>
                                <th><label for="title">Diagnosis 1 &nbsp;</label></th>
                                <td><input size="6" type="text" name="adDiagnosis1_Block" value="{{$record->adDiagnosis1_Block}}">
                                    . <input size="6" type="text" name="adDiagnosis1_BlockDetail" value="{{$record->adDiagnosis1_BlockDetail}}">
                                </td>
                                
                            </tr>
                            <tr>
                                <th><label for="title">Diagnosis 2 &nbsp;</label></th>
                                <td><input size="6" type="text" name="adDiagnosis2_Block" value="{{$record->adDiagnosis2_Block}}">
                                    . <input size="6" type="text" name="adDiagnosis2_BlockDetail" value="{{$record->adDiagnosis2_BlockDetail}}">
                                </td>
                            </tr>
                            <tr>
                                <th><label for="title">Diagnosis 3 &nbsp;</label></th>
                                <td><input size="6" type="text" name="adDiagnosis3_Block" value="{{$record->adDiagnosis3_Block}}"> . 
                                    <input size="6" type="text" name="adDiagnosis3_BlockDetail" value="{{$record->addiagnosis3_BlockDetail}}">
                                </td>
                            </tr>
                            <tr>
                                <th><label for="title">Diagnosis 4 &nbsp;</label></th>
                                <td><input size="6" type="text" name="adDiagnosis4_Block" value="{{$record->adDiagnosis4_Block}}"> . 
                                    <input size="6" type="text" name="adDiagnosis4_BlockDetail" value="{{$record->adDiagnosis4_BlockDetail}}">
                                </td>
                            </tr>
                            <tr>
                                <th><label for="title">Operation 1 &nbsp;</label></th>
                                <td><input size="6" type="text" name="adOperation1_Block" value="{{$record->adOperation1_Block}}"> . 
                                    <input size="6" type="text" name="adOperation1_BlockDetail" value="{{$record->adOperation1_BlockDetail}}">
                                </td>
                            <tr>
                                <th><label for="title">Operation 2 &nbsp;</label></th>
                                <td><input size="6" type="text" name="adOperation2_Block" value="{{$record->adOperation2_Block}}"> . 
                                    <input size="6" type="text" name="adOperation2_BlockDetail" value="{{$record->adOperation2_BlockDetail}}">
                                </td>
                            </tr>
                            <tr>
                                <th><label for="title">Death &nbsp;</label></th>
                                <td><input size="6" type="text" name="adCauseOfDeath_Block" value="{{$record->adCauseOfDeath_Block}}"> . 
                                    <input size="6" type="text" name="adCauseOfDeath_BlockDetail" value="{{$record->adCauseOfDeath_BlockDetail}}">
                                </td>
                            </tr>
                            <tr>
                                <th><label for="title">E-Code &nbsp;</label></th>
                                <td><input size="6" type="text" name="adECode_Block" value="{{$record->adECode_Block}}"> . 
                                    <input size="6" type="text" name="adECode_BlockDetail" value="{{$record->adECode_BlockDetail}}">
                                </td>
                            </tr>
                            <tr>
                                <th><label for="title">Discharge Type</label></th>
                                <td><select name="adDischargeTypeID" >
                            
                                    {{-- Stores Hospital ID in a variable to determine selected option in the dropdown --}}
                                    @php
                                        $selectedDT = $record->dtID;
                                    @endphp
                        
                                    @foreach ($dTypes as $dType)
                                    {{-- Changes selected option to the corresponding Hospital Type--}}
                                    <option value="{{ $dType->dtID }}" {{ $selectedDT == $dType->dtID ? 'selected' : '' }}>{{ $dType->dtID }}: {{ $dType->dtTitle }}</option>
                                    @endforeach
                                </select></td>
                            </tr>
                            <tr>
                                <th><label for="title">Discharge Status</label></td>
                                <td><select name="adDischargeStatusID" >
                            
                                    {{-- Stores Hospital ID in a variable to determine selected option in the dropdown --}}
                                    @php
                                        $selectedDS = $record->dsID;
                                    @endphp
                        
                                    @foreach ($dStatuses as $dStatus)
                                    {{-- Changes selected option to the corresponding Hospital Type--}}
                                    <option value="{{ $dStatus->dsID }}" {{ $selectedDS == $dStatus->dsID ? 'selected' : '' }}>{{ $dStatus->dsID }}: {{ $dStatus->dsTitle }}</option>
                                    @endforeach
                                </select></td>
                            </tr>
                        </table>
                    </div>       
                    </div>

                    
                            
                            @endforeach

                            <table style="display: flex;justify-content: center;align-items:">
                                <tr>
                                    <td><br><button class="btn btn-primary btn-lg px-4 me-sm-3" type="submit">Save</button></td>
                                    <td><br><a class="btn btn-primary btn-lg px-4 me-sm-3" style="background-color: rgb(240, 58, 58);border-color:rgb(240, 58, 58)" href="{{ route('adrecords') }}">Cancel</a></td>
                                </tr>
                            </table> 
                
            </form>
    


@endsection