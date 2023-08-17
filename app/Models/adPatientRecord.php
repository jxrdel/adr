<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class adPatientRecord extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'adPatientRecord';

    protected $primaryKey = 'adID';

    protected $fillable = [
        'adID',
        'adBatchID',
        'adRegistrationNo',
        'adSerialID',
        'adMaritalStatusID',
        'adSexID',
        'adEthnicityID',
        'adDateOfBirth',
        'adDateOfAdmission',
        'adDateOfDischarge',
        'adDateOfBirthEstimated',
        'adDateOfBirthUnknown',
        'adAgeAdmission_Years',
        'adAgeAdmission_Months',
        'adAgeAdmission_Days',
        'adAgeDischarge_Years',
        'adAgeDischarge_Months',
        'adAgeDischarge_Days',
        'adAgeGroup',
        'adLengthOfStay',
        'adDepartmentID',
        'adDiagnosis1_Block',
        'adDiagnosis1_BlockDetail',
        'adDiagnosis2_Block',
        'adDiagnosis2_BlockDetail',
        'adDiagnosis3_Block',
        'addiagnosis3_BlockDetail',
        'adDiagnosis4_Block',
        'adDiagnosis4_BlockDetail',
        'adOperation1_Block',
        'adOperation1_BlockDetail',
        'adOperation2_Block',
        'adOperation2_BlockDetail',
        'adDischargeStatusID',
        'adDischargeTypeID',
        'adCauseOfDeath_Block',
        'adCauseOfDeath_BlockDetail',
        'adECode_Block',
        'adECode_BlockDetail',
        'adExceptionalCase',
        'adExceptionalDesc',
        'adExceptionalError',
        'adHospitalID',
        'adFirstName',
        'adMiddleName',
        'adLastName',
        'adBirthPlace',
        'adAddress_Street',
        'adAddress_TownID',
        'adAddress_ZoneID',
        'adReligionID',
        'adOccupation',
        'adNextOfKin_FullName',
        'adNextOfKin_Relationship',
        'adNextOfKin_Address',
        'adEmergencyNotify_FullName',
        'adEmergencyNotify_Address',
        'adEmergencyNotify_Telephone',
        'adFatherFullName',
        'adMotherFullName',
        'adTelephoneMessage',
        'adSpecialistMedicalOfficer',
        'adHouseOfficer',
        'adBlood_HB',
        'adBlood_Group_ABO',
        'adBlood_Group_Rh',
        'adBlood_Serology_VDRL',
        'adBlood_Serology_SCT',
        'adWard',
        'adDiagnosis1_Description',
        'adDiagnosis2_Description',
        'adDiagnosis3_Description',
        'adDiagnosis4_Description',
        'adOperation1_Description',
        'adOperation2_Description',
        'adCreatedBy',
        'adCreatedDate',
        'adLastUpdatedBy',
        'adLastUpdatedDate',
    ];
}
