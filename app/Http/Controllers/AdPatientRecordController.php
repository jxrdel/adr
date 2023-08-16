<?php

namespace App\Http\Controllers;

use App\Models\adPatientRecord;
use App\Models\adSex;
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
            $record->formatted_adDateOfBirth = $formattedDOB; // Add a new attribute to the model

            $formattedDOA = Carbon::parse($record->adDateOfAdmission)->format('Y-m-d');
            $record->formatted_adDateOfAdmission = $formattedDOA; // Add a new attribute to the model

            $formattedDOD = Carbon::parse($record->adDateOfDischarge)->format('Y-m-d');
            $record->formatted_adDateOfDischarge = $formattedDOD; // Add a new attribute to the model
        }

        $sexes = adSex::all();

        return view('editadrecords', ['records' => $records], ['sexes' => $sexes]);
    }
}
