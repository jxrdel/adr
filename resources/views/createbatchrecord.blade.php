@extends('layout')

@section('main')

<div class="text-center mb-5">
    @if($errors->has('adRegistrationNo'))
        <span class="text-danger">{{ $errors->first('adRegistrationNo') }}</span>
    @endif
    <h1 class="fw-bolder">Create a Record</h1>
    <p>Batch # {{$batch->btNumber}}</p>
</div>
<div class="container" >
    
    <div class="clearfix" >
        <div class="table-container" style="margin-left: 150px">
            <form method="POST" id="editadr" action="{{ route('insertBatchRecord', ['id' => $batch->btID]) }}">
                @csrf
                @method('PUT')
                
                <table>
                    <tr>
                        {{-- Hidden row for user name --}}
                        <td style="display: none"><input size="6" type="text" name="username" value="MOH\{{auth()->user()->username}}"></td>
                        <th><label for="title">Registration Number &nbsp;</label></th>
                        <td><input required pattern="[0-9]{6}" title="Please enter 6 digits only" size="20" type="text" name="adRegistrationNo"></td>
                    </tr>
                    <tr>
                        <th><label for="title">Admission Serial No.</label></th>
                        <td><select name="adSerialID">
                
                            @foreach ($serials as $serial)
                            <option value="{{ $serial->srID }}" >{{ $serial->srIMPS_ID }}: {{ $serial->srTitle }}</option>
                            @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="title">Residential Zone</label></th>
                        <td><select name="adAddress_ZoneID" >
                            @foreach ($rzones as $rzone)
                            <option value="{{ $rzone->rzID }}">{{ $rzone->rzIMPS_ID }}: {{ $rzone->rzTitle }}</option>
                            @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="title">Marital Status</label></th>
                        <td><select name="adMaritalStatusID" >
                            @foreach ($mstatuses as $mstatus)
                            <option value="{{ $mstatus->msID }}">{{ $mstatus->msIMPS_ID }}: {{ $mstatus->msTitle }}</option>
                            @endforeach
                            </select>
                            </td>
                    </tr>
                    <tr>
                        <th><label for="title">Sex</label></th>
                        <td><select name="adSexID" >
                            @foreach ($sexes as $sex)
                            <option value="{{ $sex->sxID }}">{{ $sex->sxIMPS_ID }}: {{ $sex->sxTitle }}</option>
                            @endforeach
                        </select></td>
                    </tr>
                    <tr>
                        <th><label for="title">Ethnicity</label></th>
                        <td><select name="adEthnicityID" >
                            @foreach ($ethnicities as $ethnicity)
                            <option value="{{ $ethnicity->etID }}">{{ $ethnicity->etIMPS_ID }}: {{ $ethnicity->etTitle }}</option>
                            @endforeach
                        </select></td>
                    </tr>
                    <tr>
                        <th><label for="title">Date of Birth</label></th>
                        <td><input type="date" id="adDateOfBirth" name="adDateOfBirth">   &nbsp;&nbsp;No DOB?&nbsp;<input type="checkbox" id="nodobCheckbox" name="nodobCheckbox"></td>
                    </tr>
                    <tr class="hidden-row" style="display: none">
                        <th><label for="title">Estimated Age</label></th>
                        <td><input style="width: 80px" pattern="[0-9]*" max="130" title="Please enter digits only" id="estimatedDOB" type="number" name="estimatedDOB" size="2"> &nbsp;&nbsp;Unknown Age?&nbsp;<input id="unknownDOB" type="checkbox" name="adDateOfBirthUnknown"></td>
                    </tr>
                    <tr>
                        <th><label for="title">Date of Admission</label></th>
                        <td><input id="adDateOfAdmission" type="date" name="adDateOfAdmission" required></td>
                    </tr>
                    <tr>
                        <th><label for="title">Date of Discharge</label></th>
                        <td><input id="adDateOfDischarge" type="date" name="adDateOfDischarge" required></td>
                    </tr>
                    <tr>
                        <th><label for="title">Department &nbsp;</label></th>
                        <td><select name="adDepartmentID" >
                            @foreach ($departments as $department)
                            <option value="{{ $department->dpID }}">{{ $department->dpIMPS_ID }}: {{ $department->dpTitle }}</option>
                            @endforeach
                        </select></td>
                    </tr>
                </table>
                
                    </div>
                    
                    <div class="table-container">
                        <table>
                            <tr>
                                <th><label for="title">Diagnosis 1 &nbsp;</label></th>
                                <td><input size="6" type="text" pattern="^[A-Za-z][0-9]{2}$" title="Please enter 1 letter follower by 2 numbers" name="adDiagnosis1_Block">
                                    . <input size="6" type="text" name="adDiagnosis1_BlockDetail" pattern="^[0-9]$" title="Enter a single digit (0-9)">
                                </td>
                                
                            </tr>
                            <tr>
                                <th><label for="title">Diagnosis 2 &nbsp;</label></th>
                                <td><input size="6" type="text" name="adDiagnosis2_Block" pattern="^[A-Za-z][0-9]{2}$" title="Please enter 1 letter follower by 2 numbers">
                                    . <input size="6" type="text" name="adDiagnosis2_BlockDetail" pattern="^[0-9]$" title="Enter a single digit (0-9)">
                                </td>
                            </tr>
                            <tr>
                                <th><label for="title">Diagnosis 3 &nbsp;</label></th>
                                <td><input size="6" type="text" name="adDiagnosis3_Block" pattern="^[A-Za-z][0-9]{2}$" title="Please enter 1 letter follower by 2 numbers"> . 
                                    <input size="6" type="text" name="adDiagnosis3_BlockDetail" pattern="^[0-9]$" title="Enter a single digit (0-9)">
                                </td>
                            </tr>
                            <tr>
                                <th><label for="title">Diagnosis 4 &nbsp;</label></th>
                                <td><input size="6" type="text" name="adDiagnosis4_Block" pattern="^[A-Za-z][0-9]{3}$" title="Please enter 1 letter follower by 3 numbers"> . 
                                    <input size="6" type="text" name="adDiagnosis4_BlockDetail" pattern="^[0-9]$" title="Enter a single digit (0-9)">
                                </td>
                            </tr>
                            <tr>
                                <th><label for="title">Operation 1 &nbsp;</label></th>
                                <td><input size="6" type="text" name="adOperation1_Block" pattern="[A-Za-z0-9]{2}" title="Enter three letters or numbers"> . 
                                    <input size="6" type="text" name="adOperation1_BlockDetail" pattern="^[0-9]$" title="Enter a single digit (0-9)">
                                </td>
                            <tr>
                                <th><label for="title">Operation 2 &nbsp;</label></th>
                                <td><input size="6" type="text" name="adOperation2_Block" pattern="[A-Za-z0-9]{2}" title="Enter three letters or numbers"> . 
                                    <input size="6" type="text" name="adOperation2_BlockDetail" pattern="^[0-9]$" title="Enter a single digit (0-9)">
                                </td>
                            </tr>
                            <tr>
                                <th><label for="title">Death &nbsp;</label></th>
                                <td><input size="6" type="text" name="adCauseOfDeath_Block" pattern="^[A-Za-z][0-9]{2}$" title="Please enter 1 letter follower by 2 numbers"> . 
                                    <input size="6" type="text" name="adCauseOfDeath_BlockDetail" pattern="^[0-9]$" title="Enter a single digit (0-9)">
                                </td>
                            </tr>
                            <tr>
                                <th><label for="title">E-Code &nbsp;</label></th>
                                <td><input size="6" type="text" name="adECode_Block" pattern="^[A-Za-z][0-9]{2}$" title="Please enter 1 letter follower by 2 numbers"> . 
                                    <input size="6" type="text" name="adECode_BlockDetail" pattern="^[0-9]$" title="Enter a single digit (0-9)">
                                </td>
                            </tr>
                            <tr>
                                <th><label for="title">Discharge Status</label></td>
                                <td><select id="adDischargeStatusID" name="adDischargeStatusID" >
                                    @foreach ($dStatuses as $dStatus)
                                    <option value="{{ $dStatus->dsID }}">{{ $dStatus->dsID }}: {{ $dStatus->dsTitle }}</option>
                                    @endforeach
                                </select></td>
                            </tr>
                            <tr>
                                <th><label for="title">Discharge Type</label></th>
                                <td><select name="adDischargeTypeID" id="adDischargeTypeID">
                                    @foreach ($dTypes as $dType) 
                                    {{-- Changes selected option to the corresponding Hospital Type--}}
                                    <option value="{{ $dType->dtID }}">{{ $dType->dtID }}: {{ $dType->dtTitle }}</option>
                                    @endforeach
                                </select></td>
                            </tr>
                        </table>
                    </div>       
                    </div>

                    <table style="margin: auto">
                        <tr>
                            <td><label for="title">Exceptional Case</label> &nbsp;<input type="checkbox" id="adExceptionalCase" name="adExceptionalCase">
                                &nbsp;&nbsp;(bypass ICD Validation, requires explanation entry below)</td>
                        </tr>
                        <tr>
                            <td><textarea name="adExceptionalDesc" id="adExceptionalDesc" cols="80" rows="2"></textarea></td>
                        </tr>
                    </table>
                            
                            

                            <table style="display: flex;justify-content: center;align-items:">
                                <tr>
                                    <td><br><button class="btn btn-primary btn-lg px-4 me-sm-3" type="submit">Save</button></td>
                                    <td><br><a class="btn btn-primary btn-lg px-4 me-sm-3" style="background-color: rgb(240, 58, 58);border-color:rgb(240, 58, 58)" href="{{ route('adrecords') }}">Cancel</a></td>
                                </tr>
                            </table> 
                
            </form>
    
            <script>
                document.getElementById("editadr").addEventListener("submit", function(event) 
                {
                    event.preventDefault(); // Prevent the form from submitting by default
                    
                    // Get the values of the start date and end date fields
                    const adDateOfAdmission = new Date(document.getElementById("adDateOfAdmission").value);
                    const adDateOfDischarge = new Date(document.getElementById("adDateOfDischarge").value);
                    const adDischargeTypeID = document.getElementById("adDischargeTypeID").value;
                    const adDischargeStatusID = document.getElementById("adDischargeStatusID").value;
                    const adExceptionalCase = document.getElementById("adExceptionalCase").value;
                    const adExceptionalDesc = document.getElementById("adExceptionalDesc").value;
                    const adDateOfBirth = document.getElementById("adDateOfBirth");
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
                    }else if (!document.getElementById('nodobCheckbox').checked && adDateOfBirth.value === ""){
                        alert("Please enter Date of Birth");
                    }else if (adDateOfAdmission.getTime() > adDateOfDischarge.getTime()) {
                        // If the start date is not before the end date, show an error message
                    alert("Date of admission cannot be after date of date of discharge");
                    } else {
                    // If everything is validated
                    this.submit();

                    
                }
                
                });

                const checkbox = document.getElementById('nodobCheckbox');
                const row = document.querySelector('.hidden-row');

                // Add an event listener to the checkbox
                checkbox.addEventListener('change', function() {
                    // Toggle the visibility of the row based on the checkbox state
                    row.style.display = this.checked ? 'table-row' : 'none';
        });
            </script>

@endsection