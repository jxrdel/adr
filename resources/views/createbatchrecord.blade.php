@extends('layout')

@section('main')

<div class="text-center mb-5">
    
    <h1 class="fw-bolder">Create a Record</h1>
    <p>Batch # {{$batch->btNumber}}</p>


    <!-- Modal -->
    <div class="modal fade modal-sm" id="patientModal" tabindex="-1" aria-labelledby="patientModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="patientModalLabel" style="color:red;margin:auto">Warning <i class="bi bi-exclamation-triangle"></i></h1>
            </div>
            <div class="modal-body">
              {{-- Form to create daily register --}}
                <form>
                    <div class="mb-3" style="text-align:center">
                      <p>This batch was created by <strong>{{$batchowner}}</strong>. <br></p>
                      <p>Press 'Continue' to proceed or 'Cancel' to return to the Batches page</p>
                    </div>
                    <div class="row" style="display: flex">
                        <div class="col">
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal" style="margin:auto">Continue</button>
                        </div>
    
                        <div class="col" style="text-align: end">
                            <a href="{{ route('batches') }}"><button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close" style="margin:auto; width:90px">Cancel</button></a>
                        </div>
    
                    </div>
                  </form>
            </div>
          </div>
        </div>
        </div>
   
</div>
<div class="container" >
    
    <div class="clearfix" >

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

        <div class="table-container" style="margin-left: 150px">
            <form method="POST" id="editadr" action="{{ route('insertBatchRecord', ['id' => $batch->btID]) }}">
                @csrf
                @method('PUT')
                
                <table>
                    <tr>
                        {{-- Hidden row for user name --}}
                        <td style="display: none"><input size="6" type="text" name="username" value="{{$_SERVER['AUTH_USER']}}"></td>
                        <th><label for="title">Registration Number &nbsp;</label></th>
                        <td><input pattern="[0-9]{6}" title="Please enter 6 digits only" size="20" type="text" name="adRegistrationNo" maxlength="6" value="{{ old('adRegistrationNo') }}"></td>
                    </tr>
                    <tr>
                        <th><label for="title">Admission Serial No.</label></th>
                        <td><select name="adSerialID">
                
                            @foreach ($serials as $serial)
                            <option value="{{ $serial->srID }}" {{ old('adSerialID') == $serial->srID ? 'selected' : '' }}>{{ $serial->srIMPS_ID }}: {{ $serial->srTitle }}</option>
                            @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="title">Residential Zone</label></th>
                        <td><select name="adAddress_ZoneID" >
                            <option Value="pos" {{ old('adAddress_ZoneID') == 'pos' ? 'selected' : '' }}>0: Port-of-Spain</option>
                            <option Value="sfd" {{ old('adAddress_ZoneID') == 'sfd' ? 'selected' : '' }}>1: San Fernando</option>
                            <option Value="arm" {{ old('adAddress_ZoneID') == 'arm' ? 'selected' : '' }}>2: Arima</option>
                            <option Value="1" {{ old('adAddress_ZoneID') == '1' ? 'selected' : '' }}>3: St. George</option>
                            <option Value="2" {{ old('adAddress_ZoneID') == '2' ? 'selected' : '' }}>4: Caroni</option>
                            <option Value="3" {{ old('adAddress_ZoneID') == '3' ? 'selected' : '' }}>5: Nariva / Mayaro</option>
                            <option Value="4" {{ old('adAddress_ZoneID') == '4' ? 'selected' : '' }}>6: St. Andrew / St. David</option>
                            <option Value="5" {{ old('adAddress_ZoneID') == '5' ? 'selected' : '' }}>7: Victoria</option>
                            <option Value="6" {{ old('adAddress_ZoneID') == '6' ? 'selected' : '' }}>8: St. Patrick</option>
                            <option Value="7" {{ old('adAddress_ZoneID') == '7' ? 'selected' : '' }}>9: Tobago</option>
                            <option Value="8" {{ old('adAddress_ZoneID') == '8' ? 'selected' : '' }}>X: Not Stated</option>
                            <option Value="9" {{ old('adAddress_ZoneID') == '9' ? 'selected' : '' }}>Y: Foreign</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="title">Marital Status</label></th>
                        <td><select name="adMaritalStatusID" >
                            @foreach ($mstatuses as $mstatus)
                            <option value="{{ $mstatus->msID }}" {{ old('adMaritalStatusID') == $mstatus->msID ? 'selected' : '' }}>{{ $mstatus->msIMPS_ID }}: {{ $mstatus->msTitle }}</option>
                            @endforeach
                            </select>
                            </td>
                    </tr>
                    <tr>
                        <th><label for="title">Sex</label></th>
                        <td><select name="adSexID" >
                            @foreach ($sexes as $sex)
                            <option value="{{ $sex->sxID }}" {{ old('adSexID') == $sex->sxID ? 'selected' : '' }}>{{ $sex->sxIMPS_ID }}: {{ $sex->sxTitle }}</option>
                            @endforeach
                        </select></td>
                    </tr>
                    <tr>
                        <th><label for="title">Ethnicity</label></th>
                        <td><select name="adEthnicityID" >
                            @foreach ($ethnicities as $ethnicity)
                            <option value="{{ $ethnicity->etID }}" {{ old('adEthnicityID') == $ethnicity->etID ? 'selected' : '' }}>{{ $ethnicity->etIMPS_ID }}: {{ $ethnicity->etTitle }}</option>
                            @endforeach
                        </select></td>
                    </tr>
                    <tr>
                        <th><label for="title">Date of Birth</label></th>
                        <td><input type="date" id="adDateOfBirth" name="adDateOfBirth" value="{{ old('adDateOfBirth') }}">   &nbsp;&nbsp;No DOB?&nbsp;<input 
                            type="checkbox" id="nodobCheckbox" name="nodobCheckbox" {{ old('nodobCheckbox') ? 'checked' : '' }}></td>
                    </tr>
                    <tr class="hidden-row" style="display: none">
                        <th><label for="title">Estimated Age</label></th>
                        <td><input style="width: 80px"  pattern="[0-9]*" max="130" title="Please enter digits only" id="estimatedDOB" type="number" name="estimatedDOB" size="2"
                            value="{{ old('estimatedDOB') }}"> &nbsp;&nbsp;Unknown Age?&nbsp;<input id="unknownDOB" type="checkbox" name="adDateOfBirthUnknown" {{ old('adDateOfBirthUnknown') ? 'checked' : '' }}></td>
                    </tr>
                    <tr>
                        <th><label for="title">Date of Admission</label></th>
                        <td><input id="adDateOfAdmission" type="date" name="adDateOfAdmission" value="{{ old('adDateOfAdmission') }}"></td>
                    </tr>
                    <tr>
                        <th><label for="title">Date of Discharge</label></th>
                        <td><input id="adDateOfDischarge" type="date" name="adDateOfDischarge" value="{{ old('adDateOfDischarge') }}"></td>
                    </tr>
                    <tr>
                        <th><label for="title">Department &nbsp;</label></th>
                        <td><select name="adDepartmentID" >
                            @foreach ($departments as $department)
                            <option value="{{ $department->dpID }}" {{ old('adDepartmentID') == $department->dpID ? 'selected' : '' }}>{{ $department->dpIMPS_ID }}: {{ $department->dpTitle }}</option>
                            @endforeach
                        </select></td>
                    </tr>
                </table>
                
                    </div>
                    
                    <div class="table-container">
                        <table>
                            <tr>
                                <th><label for="title">Diagnosis 1 &nbsp;</label></th>
                                <td><input size="6" type="text" pattern="^[A-Za-z][0-9]{2}$" title="Please enter 1 letter follower by 2 numbers" name="adDiagnosis1_Block" value="{{ old('adDiagnosis1_Block') }}" maxlength="3">
                                    . <input size="6" type="text" name="adDiagnosis1_BlockDetail" pattern="^[0-9]$" title="Enter a single digit (0-9)" value="{{ old('adDiagnosis1_BlockDetail') }}" maxlength="1">
                                </td>
                                
                            </tr>
                            <tr>
                                <th><label for="title">Diagnosis 2 &nbsp;</label></th>
                                <td><input size="6" type="text" name="adDiagnosis2_Block" pattern="^[A-Za-z][0-9]{2}$" title="Please enter 1 letter follower by 2 numbers" value="{{ old('adDiagnosis2_Block') }}" maxlength="3">
                                    . <input size="6" type="text" name="adDiagnosis2_BlockDetail" pattern="^[0-9]$" title="Enter a single digit (0-9)" value="{{ old('adDiagnosis2_BlockDetail') }}" maxlength="1">
                                </td>
                            </tr>
                            <tr>
                                <th><label for="title">Diagnosis 3 &nbsp;</label></th>
                                <td><input size="6" type="text" name="adDiagnosis3_Block" pattern="^[A-Za-z][0-9]{2}$" title="Please enter 1 letter follower by 2 numbers" value="{{ old('adDiagnosis3_Block') }}" maxlength="3"> . 
                                    <input size="6" type="text" name="adDiagnosis3_BlockDetail" pattern="^[0-9]$" title="Enter a single digit (0-9)" value="{{ old('adDiagnosis3_BlockDetail') }}" maxlength="1">
                                </td>
                            </tr>
                            <tr>
                                <th><label for="title">Diagnosis 4 &nbsp;</label></th>
                                <td><input size="6" type="text" name="adDiagnosis4_Block" pattern="[A-Za-z][0-9]{0,3}" title="Please enter 1 letter followed by max 3 numbers" value="{{ old('adDiagnosis4_Block') }}" maxlength="4"> . 
                                    <input size="6" type="text" name="adDiagnosis4_BlockDetail" pattern="^[0-9]$" title="Enter a single digit (0-9)" value="{{ old('adDiagnosis4_BlockDetail') }}" maxlength="1">
                                </td>
                            </tr>
                            <tr>
                                <th><label for="title">Operation 1 &nbsp;</label></th>
                                <td><input size="6" type="text" name="adOperation1_Block" pattern="[A-Za-z0-9]{2}" title="Enter two letters or numbers" value="{{ old('adOperation1_Block') }}" maxlength="2"> . 
                                    <input size="6" type="text" name="adOperation1_BlockDetail" pattern="^[0-9]$" title="Enter a single digit (0-9)" value="{{ old('adOperation1_BlockDetail') }}" maxlength="1">
                                </td>
                            <tr>
                                <th><label for="title">Operation 2 &nbsp;</label></th>
                                <td><input size="6" type="text" name="adOperation2_Block" pattern="[A-Za-z0-9]{2}" title="Enter two letters or numbers" value="{{ old('adOperation2_Block') }}" maxlength="2"> . 
                                    <input size="6" type="text" name="adOperation2_BlockDetail" pattern="^[0-9]$" title="Enter a single digit (0-9)" value="{{ old('adOperation2_BlockDetail') }}" maxlength="1">
                                </td>
                            </tr>
                            <tr>
                                <th><label for="title">Death &nbsp;</label></th>
                                <td><input size="6" type="text" name="adCauseOfDeath_Block" maxlength="3" value="{{ old('adCauseOfDeath_Block') }}" maxlength="3"> . 
                                    <input size="6" type="text" name="adCauseOfDeath_BlockDetail" pattern="^[0-9]$" title="Enter a single digit (0-9)" value="{{ old('adCauseOfDeath_BlockDetail') }}" maxlength="1">
                                </td>
                            </tr>
                            <tr>
                                <th><label for="title">E-Code &nbsp;</label></th>
                                <td><input size="6" type="text" name="adECode_Block" maxlength="3" value="{{ old('adECode_Block') }}"> . 
                                    <input size="6" type="text" name="adECode_BlockDetail" pattern="^[0-9]$" title="Enter a single digit (0-9)" value="{{ old('adECode_BlockDetail') }}" maxlength="1">
                                </td>
                            </tr>
                            <tr>
                                <th><label for="title">Discharge Status</label></td>
                                <td><select id="adDischargeStatusID" name="adDischargeStatusID" >
                                    @foreach ($dStatuses as $dStatus)
                                    <option value="{{ $dStatus->dsID }}" {{ old('adDischargeStatusID') == $dStatus->dsID ? 'selected' : '' }}>{{ $dStatus->dsID }}: {{ $dStatus->dsTitle }}</option>
                                    @endforeach
                                </select></td>
                            </tr>
                            <tr>
                                <th><label for="title">Discharge Type</label></th>
                                <td><select name="adDischargeTypeID" id="adDischargeTypeID">
                                    @foreach ($dTypes as $dType) 
                                    {{-- Changes selected option to the corresponding Hospital Type--}}
                                    <option value="{{ $dType->dtID }}" {{ old('adDischargeTypeID') == $dType->dtID ? 'selected' : '' }}>{{ $dType->dtID }}: {{ $dType->dtTitle }}</option>
                                    @endforeach
                                </select></td>
                            </tr>
                        </table>
                    </div>       
                    </div>

                    <table style="margin: auto">
                        <tr>
                            <td><label for="title">Exceptional Case</label> &nbsp;<input type="checkbox"  {{ old('adExceptionalCase') ? 'checked' : '' }} id="adExceptionalCase" name="adExceptionalCase">
                                &nbsp;&nbsp;(bypass ICD Validation, requires explanation entry below)</td>
                        </tr>
                        <tr>
                            <td><textarea name="adExceptionalDesc" id="adExceptionalDesc" cols="80" rows="2">{{ old('adExceptionalDesc') }}</textarea></td>
                        </tr>
                    </table>
                            
                            

                    <table style="display: flex;justify-content: center;align-items:">
                        <tr>
                            <td><br><button class="btn btn-primary btn-lg px-4 me-sm-3" type="submit">Save</button></td>
                            <td><br><a class="btn btn-primary btn-lg px-4 me-sm-3" style="background-color: rgb(240, 58, 58);border-color:rgb(240, 58, 58)" href="{{ route('batches') }}">Cancel</a></td>
                        </tr>
                    </table> 
                
            </form>
			
			@if (Str::lower($_SERVER['AUTH_USER']) !== $batchowner)
			<!--Modal JS Script -->
			<script type="text/javascript">
				window.onload = () => {
					$('#patientModal').modal('show');
				}
			</script>
			@endif
    
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
                    } else if (!document.getElementById('nodobCheckbox').checked && !isDateValid(adDateOfBirth.value)){
                        // Checks DOB
                    alert("Please check date of birth");
                    } else if (document.getElementById("adDateOfAdmission").value !== "" && !isDateValid(adDateOfAdmission)){
                        // Checks DOA
                    alert("Please check date of admission");
                    } else if (document.getElementById("adDateOfDischarge").value !== "" && !isDateValid(adDateOfDischarge)){
                        // Checks DOD
                    alert("Please check date of discharge");
                    }else {
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