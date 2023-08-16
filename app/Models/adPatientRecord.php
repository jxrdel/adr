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
        'adIMPS_BatchID',
        'adRegistrationNo',
        'adIDMPS_SerialNo',
        'adMaritalStatusID',
        'adSexID',
        'adEthnicityID',
        'adAge',
        'adIDMPS_AgeGroupID',
        'adAgeSupplied',
        'adAdmissionDate',
        'adDischargeDate',
        'adIDMPS_LengthOfStay',
        'adIDMPS_AdmissionMonth',
        'adIDMPS_AdmissionYear',
        'adIDMPS_DischargeMonth',
        'adIDMPS_DischargeYear',
        'adDepartmentID',
        'adDDiagnosis1_Block',
        'adDDiagnosis1_BlockDetail',
        'adDDiagnosis2_Block',
        'adDDiagnosis2_BlockDetail',
        'adDDiagnosis3_Block',
        'addDiagnosis3_BlockDetail',
        'adDDiagnosis4_Block',
        'adDDiagnosis4_BlockDetail',
        'adOperation1',
        'adOperation2',
        'adDischargeStatusID',
        'adDischargeTypeID',
        'adCDauseOfDeath_Block',
        'adCDauseOfDeath_BlockDetail',
        'adIDMPS_DeathAge',
        'adIDMPS_DeathAgeGroupID',
        'adECode',
        'adEDCode_Block',
        'adEDCode_BlockDetail',
        'adHospitalID',
        'adFirstName',
        'adMiddleName',
        'adLastName',
        'adBirthPlace',
        'adADddress_Street',
        'adADddress_TownID',
        'adIDMPS_Address_ZoneID',
        'adDOB',
        'adReligionID',
        'adOccupation',
        'adNDextOfKin_FullName',
        'adNDextOfKin_Relationship',
        'adNDextOfKin_Address',
        'adEDmergencyNotify_FullName',
        'adEDmergencyNotify_Address',
        'adEDmergencyNotify_Telephone',
        'adFatherFullName',
        'adMotherFullName',
        'adTelephoneMessage',
        'adSpecialistMedicalOfficer',
        'adHouseOfficer',
        'adBDlood_HB',
        'adBDlood_Group_ABO',
        'adBDlood_Group_Rh',
        'adBDlood_Serology_VDRL',
        'adBDlood_Serology_SCT',
        'adWard',
        'adDDiagnosis1_Description',
        'adDDiagnosis2_Description',
        'adDDiagnosis3_Description',
        'adDDiagnosis4_Description',
        'adODperation1_Description',
        'adODperation2_Description',
    ];
}
