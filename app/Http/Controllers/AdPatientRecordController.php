<?php

namespace App\Http\Controllers;

use App\Models\adDepartment;
use App\Models\adDischargeStatus;
use App\Models\adDischargeType;
use App\Models\adEthnicity;
use App\Models\adMaritalStatus;
use App\Models\adPatientRecord;
use App\Models\adResidenceZone;
use App\Models\adSex;
use App\Models\adSerial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdPatientRecordController extends Controller
{
    public function index(){

        $sqlQuery = 'SELECT adPatientRecord.adID, adPatientRecord.adBatchID, adPatientRecordBatch.btID, adPatientRecordBatch.btNumber, adPatientRecordBatch.btHospitalID, adHospitals.hsID, adHospitals.hsTypeID, 
        adHospitals.hsTitle, adPatientRecord.adRegistrationNo, adPatientRecord.adSerialID, adSerial.srID, adSerial.srIMPS_ID, adSerial.srTitle, adPatientRecord.adMaritalStatusID, 
        adMaritalStatus.msID, adMaritalStatus.msIMPS_ID, adMaritalStatus.msTitle, adPatientRecord.adSexID, adSex.sxID, adSex.sxIMPS_ID, adSex.sxTitle, adPatientRecord.adEthnicityID, 
        adEthnicity.etID, adEthnicity.etIMPS_ID, adEthnicity.etTitle, adPatientRecord.adDepartmentID, adDepartment.dpID, adDepartment.dpIMPS_ID, adDepartment.dpTitle, 
        adPatientRecord.adAddress_TownID, adResidenceTown.rtID, adResidenceTown.rtResidenceZoneID, adResidenceTown.rtTitle, adPatientRecord.adAddress_ZoneID, adResidenceZone.rzID, 
        adResidenceZone.rzIMPS_ID, adResidenceZone.rzTitle, adPatientRecord.adDateOfBirth, adPatientRecord.adDateOfAdmission, adPatientRecord.adDateOfDischarge, 
        adPatientRecord.adDischargeStatusID, adDischargeStatus.dsID, adDischargeStatus.dsIMPS_ID, adDischargeStatus.dsTitle, adPatientRecord.adDischargeTypeID, adDischargeType.dtID, 
        adDischargeType.dtIMPS_ID, adDischargeType.dtTitle, adPatientRecord.adDiagnosis1_Block, adPatientRecord.adDiagnosis1_BlockDetail, adPatientRecord.adDiagnosis2_Block, 
        adPatientRecord.adDiagnosis2_BlockDetail, adPatientRecord.adDiagnosis3_Block, adPatientRecord.addiagnosis3_BlockDetail, adPatientRecord.adDiagnosis4_Block, 
        adPatientRecord.adDiagnosis4_BlockDetail, adPatientRecord.adOperation1_Block, adPatientRecord.adOperation1_BlockDetail, adPatientRecord.adOperation2_Block, 
        adPatientRecord.adOperation2_BlockDetail, adPatientRecord.adCauseOfDeath_Block, adPatientRecord.adCauseOfDeath_BlockDetail, adPatientRecord.adECode_Block, 
        adPatientRecord.adECode_BlockDetail, adPatientRecord.adReligionID, adPatientRecord.adCreatedBy, adPatientRecord.adCreatedDate, adPatientRecord.adLastUpdatedBy, 
        adPatientRecord.adLastUpdatedDate, adPatientRecord.adDateOfBirthEstimated, adPatientRecord.adDateOfBirthUnknown, adPatientRecord.adAgeAdmission_Years, 
        adPatientRecord.adAgeAdmission_Months, adPatientRecord.adAgeAdmission_Days, adPatientRecord.adAgeDischarge_Years, adPatientRecord.adAgeDischarge_Months, 
        adPatientRecord.adAgeDischarge_Days, adPatientRecord.adLengthOfStay
        FROM            adPatientRecord INNER JOIN
        adPatientRecordBatch ON adPatientRecord.adBatchID = adPatientRecordBatch.btID INNER JOIN
        adHospitals ON adPatientRecordBatch.btHospitalID = adHospitals.hsID INNER JOIN
        adSerial ON adPatientRecord.adSerialID = adSerial.srID INNER JOIN
        adMaritalStatus ON adPatientRecord.adMaritalStatusID = adMaritalStatus.msID INNER JOIN
        adSex ON adPatientRecord.adSexID = adSex.sxID INNER JOIN
        adEthnicity ON adPatientRecord.adEthnicityID = adEthnicity.etID INNER JOIN
        adDepartment ON adPatientRecord.adDepartmentID = adDepartment.dpID INNER JOIN
        adResidenceZone ON adPatientRecord.adAddress_ZoneID = adResidenceZone.rzID INNER JOIN
        adDischargeStatus ON adPatientRecord.adDischargeStatusID = adDischargeStatus.dsID INNER JOIN
        adDischargeType ON adPatientRecord.adDischargeTypeID = adDischargeType.dtID LEFT OUTER JOIN
        adReligion ON adPatientRecord.adReligionID = adReligion.rgID LEFT OUTER JOIN
        adResidenceTown ON adPatientRecord.adAddress_TownID = adResidenceTown.rtID';

        $records = DB::select($sqlQuery);

        return view('adrecords', ['records' => $records]);
    }

    public function edit($id){

        $sqlQuery = 'SELECT adPatientRecord.adID, adPatientRecord.adBatchID, adPatientRecordBatch.btID, adPatientRecordBatch.btNumber, adPatientRecordBatch.btHospitalID, adHospitals.hsID, adHospitals.hsTypeID, 
        adHospitals.hsTitle, adPatientRecord.adRegistrationNo, adPatientRecord.adSerialID, adSerial.srID, adSerial.srIMPS_ID, adSerial.srTitle, adPatientRecord.adMaritalStatusID, 
        adMaritalStatus.msID, adMaritalStatus.msIMPS_ID, adMaritalStatus.msTitle, adPatientRecord.adSexID, adSex.sxID, adSex.sxIMPS_ID, adSex.sxTitle, adPatientRecord.adEthnicityID, 
        adEthnicity.etID, adEthnicity.etIMPS_ID, adEthnicity.etTitle, adPatientRecord.adDepartmentID, adDepartment.dpID, adDepartment.dpIMPS_ID, adDepartment.dpTitle, 
        adPatientRecord.adAddress_TownID, adResidenceTown.rtID, adResidenceTown.rtResidenceZoneID, adResidenceTown.rtTitle, adPatientRecord.adAddress_ZoneID, adResidenceZone.rzID, 
        adResidenceZone.rzIMPS_ID, adResidenceZone.rzTitle, adPatientRecord.adDateOfBirth, adPatientRecord.adDateOfAdmission, adPatientRecord.adDateOfDischarge, 
        adPatientRecord.adDischargeStatusID, adDischargeStatus.dsID, adDischargeStatus.dsIMPS_ID, adDischargeStatus.dsTitle, adPatientRecord.adDischargeTypeID, adDischargeType.dtID, 
        adDischargeType.dtIMPS_ID, adDischargeType.dtTitle, adPatientRecord.adDiagnosis1_Block, adPatientRecord.adDiagnosis1_BlockDetail, adPatientRecord.adDiagnosis2_Block, 
        adPatientRecord.adDiagnosis2_BlockDetail, adPatientRecord.adDiagnosis3_Block, adPatientRecord.addiagnosis3_BlockDetail, adPatientRecord.adDiagnosis4_Block, 
        adPatientRecord.adDiagnosis4_BlockDetail, adPatientRecord.adOperation1_Block, adPatientRecord.adOperation1_BlockDetail, adPatientRecord.adOperation2_Block, 
        adPatientRecord.adOperation2_BlockDetail, adPatientRecord.adCauseOfDeath_Block, adPatientRecord.adCauseOfDeath_BlockDetail, adPatientRecord.adECode_Block, 
        adPatientRecord.adECode_BlockDetail, adPatientRecord.adReligionID, adPatientRecord.adCreatedBy, adPatientRecord.adCreatedDate, adPatientRecord.adLastUpdatedBy, 
        adPatientRecord.adLastUpdatedDate, adPatientRecord.adDateOfBirthEstimated, adPatientRecord.adDateOfBirthUnknown, adPatientRecord.adAgeAdmission_Years, 
        adPatientRecord.adExceptionalCase,adPatientRecord.adExceptionalDesc,
        adPatientRecord.adAgeAdmission_Months, adPatientRecord.adAgeAdmission_Days, adPatientRecord.adAgeDischarge_Years, adPatientRecord.adAgeDischarge_Months, 
        adPatientRecord.adAgeDischarge_Days, adPatientRecord.adLengthOfStay
        FROM adPatientRecord  INNER JOIN
        adPatientRecordBatch ON adPatientRecord.adBatchID = adPatientRecordBatch.btID INNER JOIN
        adHospitals ON adPatientRecordBatch.btHospitalID = adHospitals.hsID INNER JOIN
        adSerial ON adPatientRecord.adSerialID = adSerial.srID INNER JOIN
        adMaritalStatus ON adPatientRecord.adMaritalStatusID = adMaritalStatus.msID INNER JOIN
        adSex ON adPatientRecord.adSexID = adSex.sxID INNER JOIN
        adEthnicity ON adPatientRecord.adEthnicityID = adEthnicity.etID INNER JOIN
        adDepartment ON adPatientRecord.adDepartmentID = adDepartment.dpID INNER JOIN
        adResidenceZone ON adPatientRecord.adAddress_ZoneID = adResidenceZone.rzID INNER JOIN
        adDischargeStatus ON adPatientRecord.adDischargeStatusID = adDischargeStatus.dsID INNER JOIN
        adDischargeType ON adPatientRecord.adDischargeTypeID = adDischargeType.dtID LEFT OUTER JOIN
        adReligion ON adPatientRecord.adReligionID = adReligion.rgID LEFT OUTER JOIN
        adResidenceTown ON adPatientRecord.adAddress_TownID = adResidenceTown.rtID 
        WHERE adPatientRecord.adID = ?';

        $records = DB::select($sqlQuery, [$id]);

        //Format Dates
        foreach ($records as $record) {
            $formattedDOB = Carbon::parse($record->adDateOfBirth)->format('Y-m-d');
            $record->formatted_adDateOfBirth = $formattedDOB; 

            $formattedDOA = Carbon::parse($record->adDateOfAdmission)->format('Y-m-d');
            $record->formatted_adDateOfAdmission = $formattedDOA; 

            $formattedDOD = Carbon::parse($record->adDateOfDischarge)->format('Y-m-d');
            $record->formatted_adDateOfDischarge = $formattedDOD;
        }

        $sexes = adSex::all();
        $serials = adSerial::all();
        $rzones = adResidenceZone::all();
        $mstatuses = adMaritalStatus::all();
        $dStatuses = adDischargeStatus::all();
        $dTypes = adDischargeType::all();
        $ethnicities = adEthnicity::all();
        $departments = adDepartment::all();

        //Combine all the arrays to send it to editrecords view
        $combined = compact('sexes', 'serials', 'rzones', 'mstatuses', 'dStatuses', 'dTypes', 'ethnicities', 'departments');

        return view('editadrecords', ['records' => $records], $combined);
    }

    

    public function update(Request $request, $id){

        //If a change is made to the batch record, validation is done to ensure new batch number is unique
        $previous = adPatientRecord::find($id);
        $previousRegNo = $previous->adRegistrationNo;
        $newRegNo = $request->input('adRegistrationNo');


        if ($previousRegNo != $newRegNo){
            $request->validate([
                'adRegistrationNo' => 'unique:adPatientRecord,adRegistrationNo',
            ]);
        }

        //Set time for last updated
        $lastUpdated = Carbon::now();
        $lastUpdated = $lastUpdated->format('Y-m-d H:i:s');

        //Set value for adDateOfBirthUnknown depending on if checkbox is selected
        $adDateOfBirthUnknown = $request->has('adDateOfBirthUnknown') ? 1 : 0;

        //Check if 'No Date of Birth' checkbox is selected
        $noDOB = $request->has('nodobCheckbox') ? 1 : 0;

        //Set estimated Date of Birth
        if ($noDOB == '1' && $adDateOfBirthUnknown == '0'){

                $years = $request->input('estimatedDOB');
                $today = Carbon::now();
                $estimatedDOB = $today->subYears($years);
                $estimatedDOB = $estimatedDOB->format('Y-m-d');
                $dobADR = $estimatedDOB;
                $isEstimated = 1;

        }else{
            $dobADR = $request->input('adDateOfBirth'); //DOB is unchanged if there is no estimated DOB
            $isEstimated = 0;
        }
        
        //Set value for adExceptionalCase depending on if checkbox is selected
        $adExceptionalCase = $request->has('adExceptionalCase') ? 1 : 0;

        adPatientRecord::where('adID', $id)->update([
            'adRegistrationNo' => $request->input('adRegistrationNo'),
            'adSerialID' => $request->input('adSerialID'),
            'adAddress_ZoneID' => $request->input('adAddress_ZoneID'),
            'adMaritalStatusID' => $request->input('adMaritalStatusID'),
            'adSexID' => $request->input('adSexID'),
            'adEthnicityID' => $request->input('adEthnicityID'),
            'adDateOfBirth' => $dobADR,
            'adDateOfBirthEstimated' => $isEstimated,
            'adDateOfBirthUnknown' => $adDateOfBirthUnknown,
            'adDateOfAdmission' => $request->input('adDateOfAdmission'),
            'adDateOfDischarge' => $request->input('adDateOfDischarge'),
            'adDepartmentID' => $request->input('adDepartmentID'),
            'adDiagnosis1_Block' => $request->input('adDiagnosis1_Block'),
            'adDiagnosis1_BlockDetail' => $request->input('adDiagnosis1_BlockDetail'),
            'adDiagnosis2_Block' => $request->input('adDiagnosis2_Block'),
            'adDiagnosis2_BlockDetail' => $request->input('adDiagnosis2_BlockDetail'),
            'adDiagnosis3_Block' => $request->input('adDiagnosis3_Block'),
            'addiagnosis3_BlockDetail' => $request->input('addiagnosis3_BlockDetail'),
            'adDiagnosis4_Block' => $request->input('adDiagnosis4_Block'),
            'adDiagnosis4_BlockDetail' => $request->input('adDiagnosis4_BlockDetail'),
            'adOperation1_Block' => $request->input('adOperation1_Block'),
            'adOperation1_BlockDetail' => $request->input('adOperation1_BlockDetail'),
            'adOperation2_Block' => $request->input('adOperation2_Block'),
            'adOperation2_BlockDetail' => $request->input('adOperation2_BlockDetail'),
            'adECode_Block' => $request->input('adECode_Block'),
            'adECode_BlockDetail' => $request->input('adECode_BlockDetail'),
            'adDischargeStatusID' => $request->input('adDischargeStatusID'),
            'adDischargeTypeID' => $request->input('adDischargeTypeID'),
            'adLastUpdatedDate' => $lastUpdated,
            'adLastUpdatedBy' => $request->input('username'),
            'adExceptionalCase' => $adExceptionalCase,
            'adExceptionalDesc' => $request->input('adExceptionalDesc'),            
        ]);
        
    
        return redirect()->route('adrecords')->with('success', 'Hospital updated successfully.');
    }
}
