@extends('layout')

@section('main')

<div class="text-center mb-5">
    <h1 class="fw-bolder">Edit Record</h1>
    
    @php
        $thisYear = \Carbon\Carbon::now()->format('Y');
    @endphp

    {{-- Display errors --}}
    @if($errors->any())
        <div class="alert alert-danger" style="display:flex; justify-content:center">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>

<div class="container" >

    @foreach ($records as $record)
    <div class="clearfix" >
        <div class="table-container" style="margin-left: 150px">
            
            <form method="POST" id="editadr" action="{{ route('updateadrecords', ['id' => $record->adID]) }}">
                @csrf
                @method('PUT')
                
                <table>
                    <tr>
                        <th><label for="title">Registration Number &nbsp;</label></th>
                        {{-- Input field only allows an input of 6 digits --}}
                        <td><input pattern="[0-9]{6}" title="Please enter 6 digits only" size="20" type="text" name="adRegistrationNo" value="{{$record->adRegistrationNo}}"></td>
                    </tr>

                    <tr>
                        <th><label for="title">Admission Serial No.</label></th>
                        <td><select name="adSerialID" >
                    
                            {{-- Stores Serial ID in a variable to determine selected option in the dropdown --}}
                            @php
                                $selectedserial = $record->srID;
                            @endphp
                
                            @foreach ($serials as $serial)
                            {{-- Changes selected option to the corresponding Serial--}}
                            <option value="{{ $serial->srID }}" {{ $selectedserial == $serial->srID ? 'selected' : '' }}>{{ $serial->srIMPS_ID }}: {{ $serial->srTitle }}</option>
                            @endforeach
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <th><label for="title">Residential Zone</label></th>

                        @php
                                $selectedrz = $record->rzID;
                        @endphp

                        <td><select name="adAddress_ZoneID" >
                            <option Value="pos">0: Port-of-Spain</option>
                            <option Value="sfd">1: San Fernando</option>
                            <option Value="arm">2: Arima</option>
                            <option value="1" {{ $selectedrz == 1 ? 'selected' : '' }}>3: St. George</option>
                            <option Value="2" {{ $selectedrz == 2 ? 'selected' : '' }}>4: Caroni</option>
                            <option Value="3" {{ $selectedrz == 3 ? 'selected' : '' }}>5: Nariva / Mayaro</option>
                            <option Value="4" {{ $selectedrz == 4 ? 'selected' : '' }}>6: St. Andrew / St. David</option>
                            <option Value="5" {{ $selectedrz == 5 ? 'selected' : '' }}>7: Victoria</option>
                            <option Value="6" {{ $selectedrz == 6 ? 'selected' : '' }}>8: St. Patrick</option>
                            <option Value="7" {{ $selectedrz == 7 ? 'selected' : '' }}>9: Tobago</option>
                            <option Value="8" {{ $selectedrz == 8 ? 'selected' : '' }}>X: Not Stated</option>
                            <option Value="9" {{ $selectedrz == 9 ? 'selected' : '' }}>Y: Foreign</option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <th><label for="title">Marital Status</label></th>
                        <td><select name="adMaritalStatusID" >
                    
                            {{-- Stores Marital Status in a variable to determine selected option in the dropdown --}}
                            @php
                                $selectedMS = $record->msID;
                            @endphp
                
                            @foreach ($mstatuses as $mstatus)
                            {{-- Changes selected option to the corresponding Marital Status--}}
                            <option value="{{ $mstatus->msID }}" {{ $selectedMS == $mstatus->msID ? 'selected' : '' }}>{{ $mstatus->msIMPS_ID }}: {{ $mstatus->msTitle }}</option>
                            @endforeach
                            </select>
                            </td>
                    </tr>

                    <tr>
                        <th><label for="title">Sex</label></th>
                        <td><select name="adSexID" >
                    
                            {{-- Stores Sex in a variable to determine selected option in the dropdown --}}
                            @php
                                $selectedsex = $record->sxIMPS_ID;
                            @endphp
                
                            @foreach ($sexes as $sex)
                            {{-- Changes selected option to the corresponding Sex--}}
                            <option value="{{ $sex->sxID }}" {{ $selectedsex == $sex->sxIMPS_ID ? 'selected' : '' }}>{{ $sex->sxIMPS_ID }}: {{ $sex->sxTitle }}</option>
                            @endforeach
                        </select></td>
                    </tr>
                    <tr>
                        <th><label for="title">Ethnicity</label></th>
                        <td><select name="adEthnicityID" >
                    
                            {{-- Stores Ethnicity in a variable to determine selected option in the dropdown --}}
                            @php
                                $selectedETH = $record->adEthnicityID;
                            @endphp
                
                            @foreach ($ethnicities as $ethnicity)
                            {{-- Changes selected option to the corresponding Ethnicity--}}
                            <option value="{{ $ethnicity->etID }}" {{ $selectedETH == $ethnicity->etID ? 'selected' : '' }}>{{ $ethnicity->etIMPS_ID }}: {{ $ethnicity->etTitle }}</option>
                            @endforeach
                        </select></td>
                    </tr>

                    <tr>
                        <th><label for="title">Date of Birth</label></th>
                        <td><input id="adDateOfBirth" type="date" name="adDateOfBirth" value="{{$record->formatted_adDateOfBirth}}">   &nbsp;&nbsp;No DOB?&nbsp;<input type="checkbox" id="nodobCheckbox" name="nodobCheckbox"></td>
                    </tr>

                    <tr class="hidden-row" style="display: none">
                        <th><label for="title">Estimated Age</label></th>
                        <td><input style="width: 80px" pattern="[0-9]*" max="130" title="Please enter digits only" id="estimatedDOB" type="number" name="estimatedDOB" size="2"> &nbsp;&nbsp;Unknown Age?&nbsp;<input id="unknownDOB" type="checkbox" name="adDateOfBirthUnknown"></td>
                    </tr>

                    <tr>
                        <th><label for="title">Date of Admission</label></th>
                        <td><input id="adDateOfAdmission" type="date" name="adDateOfAdmission" value="{{$record->formatted_adDateOfAdmission}}"></td>
                    </tr>

                    <tr>
                        <th><label for="title">Date of Discharge</label></th>
                        <td><input id="adDateOfDischarge" type="date" name="adDateOfDischarge" value="{{$record->formatted_adDateOfDischarge}}"></td>
                    </tr>

                    <tr>
                        <th><label for="title">Department &nbsp;</label></th>
                        <td><select name="adDepartmentID" >
                    
                            {{-- Stores Department ID in a variable to determine selected option in the dropdown --}}
                            @php
                                $selectedDPT = $record->adDepartmentID;
                            @endphp
                
                            @foreach ($departments as $department)
                            {{-- Changes selected option to the corresponding Department--}}
                            <option value="{{ $department->dpID }}" {{ $selectedDPT == $department->dpID ? 'selected' : '' }}>{{ $department->dpIMPS_ID }}: {{ $department->dpTitle }}</option>
                            @endforeach
                        </select></td>
                    </tr>
                </table>
                
                    </div>
                    
                    <div class="table-container">
                        <table>
                            <tr style="display: none">
                                <th><input size="6" type="text" name="username" value="{{$_SERVER['AUTH_USER']}}"></th>
                                
                            </tr>
                            <tr>
                                <th><label for="title">Diagnosis 1 &nbsp;</label></th>
                                <td><input size="6" type="text" name="adDiagnosis1_Block" pattern="^[A-Za-z][0-9]{2}$" title="Please enter 1 letter followed by 2 numbers" value="{{$record->adDiagnosis1_Block}}" maxlength="3">
                                    . <input size="6" type="text" name="adDiagnosis1_BlockDetail" pattern="^[0-9]$" title="Please enter 1 digit" value="{{$record->adDiagnosis1_BlockDetail}}" maxlength="1">
                                </td>
                                
                            </tr>
                            <tr>
                                <th><label for="title">Diagnosis 2 &nbsp;</label></th>
                                <td><input size="6" type="text" name="adDiagnosis2_Block" pattern="^[A-Za-z][0-9]{2}$" title="Please enter 1 letter followed by 2 numbers" value="{{$record->adDiagnosis2_Block}}" maxlength="3">
                                    . <input size="6" type="text" name="adDiagnosis2_BlockDetail" value="{{$record->adDiagnosis2_BlockDetail}}" maxlength="1">
                                </td>
                            </tr>
                            <tr>
                                <th><label for="title">Diagnosis 3 &nbsp;</label></th>
                                <td><input size="6" type="text" name="adDiagnosis3_Block" pattern="^[A-Za-z][0-9]{2}$" title="Please enter 1 letter followed by 2 numbers" value="{{$record->adDiagnosis3_Block}}" maxlength="3"> . 
                                    <input size="6" type="text" name="addiagnosis3_BlockDetail" value="{{$record->addiagnosis3_BlockDetail}}" maxlength="1">
                                </td>
                            </tr>
                            <tr>
                                <th><label for="title">Diagnosis 4 &nbsp;</label></th>
                                <td><input size="6" type="text" name="adDiagnosis4_Block" pattern="^[A-Za-z][0-9]{0,3}" title="Please enter 1 letter followed by max 3 numbers" value="{{$record->adDiagnosis4_Block}}" maxlength="4"> . 
                                    <input size="6" type="text" name="adDiagnosis4_BlockDetail" value="{{$record->adDiagnosis4_BlockDetail}}" maxlength="1">
                                </td>
                            </tr>
                            <tr>
                                <th><label for="title">Operation 1 &nbsp;</label></th>
                                <td><input size="6" type="text" name="adOperation1_Block" value="{{$record->adOperation1_Block}}" maxlength="2"> . 
                                    <input size="6" type="text" name="adOperation1_BlockDetail" value="{{$record->adOperation1_BlockDetail}}" maxlength="1">
                                </td>
                            <tr>
                                <th><label for="title">Operation 2 &nbsp;</label></th>
                                <td><input size="6" type="text" name="adOperation2_Block" value="{{$record->adOperation2_Block}}" maxlength="2"> . 
                                    <input size="6" type="text" name="adOperation2_BlockDetail" value="{{$record->adOperation2_BlockDetail}}" maxlength="1">
                                </td>
                            </tr>
                            <tr>
                                <th><label for="title">Death &nbsp;</label></th>
                                <td><input size="6" type="text" name="adCauseOfDeath_Block" value="{{$record->adCauseOfDeath_Block}}" maxlength="3"> . 
                                    <input size="6" type="text" name="adCauseOfDeath_BlockDetail" value="{{$record->adCauseOfDeath_BlockDetail}}" maxlength="1">
                                </td>
                            </tr>
                            <tr>
                                <th><label for="title">E-Code &nbsp;</label></th>
                                <td><input size="6" type="text" name="adECode_Block" value="{{$record->adECode_Block}}"  maxlength="3"> . 
                                    <input size="6" type="text" name="adECode_BlockDetail" value="{{$record->adECode_BlockDetail}}" maxlength="1">
                                </td>
                            </tr>
                            <tr>
                                <th><label for="title">Discharge Status</label></td>
                                <td><select id="adDischargeStatusID" name="adDischargeStatusID" >
                            
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
                            <tr>
                                <th><label for="title">Discharge Type</label></th>
                                <td><select name="adDischargeTypeID" id="adDischargeTypeID">
                            
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
                        </table>

                        
                    </div>       
                    </div>
                    
                    <table style="margin: auto">
                        <tr>
                            <td><label for="title">Exceptional Case</label> &nbsp;<input type="checkbox" id="adExceptionalCase" name="adExceptionalCase"{{ $record->adExceptionalCase == 1 ? 'checked' : '' }}>
                                &nbsp;&nbsp;(bypass ICD Validation, requires explanation entry below)</td>
                        </tr>
                        <tr>
                            <td><textarea name="adExceptionalDesc" id="adExceptionalDesc" cols="80" rows="2">{{$record->adExceptionalDesc}}</textarea></td>
                        </tr>
                    </table>

                            @endforeach

                            <table style="display: flex;justify-content: center;align-items:">
                                <tr>
                                    <td><br><button class="btn btn-primary btn-lg px-4 me-sm-3" type="submit">Save</button></td>
                                    <td><br><a class="btn btn-primary btn-lg px-4 me-sm-3" style="background-color: rgb(240, 58, 58);border-color:rgb(240, 58, 58)" href="{{ route('records', ['year' => $thisYear, 'page' => 1]) }}">Cancel</a></td>
                                </tr>
                            </table> 
                
            </form>
    
            <script>
                document.getElementById("editadr").addEventListener("submit", function(event) 
                {
                    event.preventDefault(); // Prevent the form from submitting by default
                    
                    // Get the values of the fields
                    const adDateOfAdmission = new Date(document.getElementById("adDateOfAdmission").value);
                    const adDateOfDischarge = new Date(document.getElementById("adDateOfDischarge").value);
                    const adDischargeTypeID = document.getElementById("adDischargeTypeID").value;
                    const adDischargeStatusID = document.getElementById("adDischargeStatusID").value;
                    const adExceptionalCase = document.getElementById("adExceptionalCase").value;
                    const adExceptionalDesc = document.getElementById("adExceptionalDesc").value;
                    const adDateOfBirth = document.getElementById("adDateOfBirth").value;
                    const estimatedDOB = document.getElementById("estimatedDOB");

                    if (document.getElementById('nodobCheckbox').checked && !document.getElementById('unknownDOB').checked && estimatedDOB.value === '') {
                        // User has to enter estimated age if the No DOB checkbox is selected and if the Unknown DOB checkbox is not selected
                        alert('Please enter estimated age');
                    }else if ((adDischargeTypeID == 6 && adDischargeStatusID < 5) || (adDischargeStatusID >= 5 && adDischargeTypeID < 6)){
                        //Validation of Discharge Types/Statuses
                        alert("Discharge Type does not match Discharge Status");
                    }else if (document.getElementById('adExceptionalCase').checked && adExceptionalDesc == '') {
                        // User has to enter estimated age if the No DOB checkbox is selected and if the Unknown DOB checkbox is not selected
                        alert('Please enter exceptional case details');
                    }else if (adDateOfAdmission.getTime() > adDateOfDischarge.getTime()) {
                        // If the start date is not before the end date, show an error message
                    alert("Date of admission cannot be after date of date of discharge");
                    }else if (!isDateValid(adDateOfBirth)){
                        // Checks DOB
                    alert("Please check date of birth");
                    } else if (!isDateValid(adDateOfAdmission)){
                        // Checks DOB
                    alert("Please check date of admission");
                    } else if (!isDateValid(adDateOfDischarge)){
                        // Checks DOB
                    alert("Please check date of discharge");
                    } else {
                    // If everything is validated
                    this.submit();

                    
                }
                
                });
				
				
				function isDateValid(inputDate) {
                    // Create a Max and minimum dates
                    const mindate = new Date(1900, 0, 1); // Months are zero-based (0 = January)
                    const maxdate = new Date(9999, 0, 1); // Months are zero-based (0 = January)

                    // Create a Date object from the input date string
                    const inputDateObject = new Date(inputDate);

                   
                    return (mindate < inputDateObject) && (inputDateObject < maxdate);
                }

                const checkbox = document.getElementById('nodobCheckbox');
                const row = document.querySelector('.hidden-row');

                // Add an event listener to the checkbox
                checkbox.addEventListener('change', function() {
                    // Toggle the visibility of the row based on the checkbox state
                    row.style.display = this.checked ? 'table-row' : 'none';
        });
            </script>

@endsection