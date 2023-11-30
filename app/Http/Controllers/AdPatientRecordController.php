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
use App\Models\adAgeGroups;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Rules\AgeDiagnosis;
use App\Rules\GenderDiagnosis;
use App\Rules\InvalidDiagnosisCode;
use App\Rules\InvalidECode;
use App\Rules\MissingECode;
use Illuminate\Support\Facades\Validator;

class AdPatientRecordController extends Controller
{
    public function index()
    {

        $records = adPatientRecord::select(
            'adPatientRecord.*',
            'adPatientRecordBatch.btID',
            'adPatientRecordBatch.btNumber',
            'adPatientRecordBatch.btHospitalID',
            'adHospitals.hsID',
            'adHospitals.hsTypeID',
            'adHospitals.hsTitle'
        )
            ->join('adPatientRecordBatch', 'adPatientRecord.adBatchID', '=', 'adPatientRecordBatch.btID')
            ->join('adHospitals', 'adPatientRecordBatch.btHospitalID', '=', 'adHospitals.hsID')
            ->get();

        return view('adrecords', ['records' => $records]);
    }

    public function edit($id)
    {

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

    private function getAddressTownID($value)
    {
        switch ($value) {
            case 'pos':
                // ' Town: Port-of-Spain
                $town = '1';
                return $town;
                break;

            case 'sfd':
                // Town: San Fernando
                $town = '2';
                return $town;
                break;

            case 'arm':
                // Town: Arima
                $town = '3';
                return $town;
                break;

            default:
                // Unknown Town
                $town = '0';
                return $town;
                break;
        }
    }

    private function getAddressZoneID($value)
    {
        switch ($value) {
            case 'pos':
                // ' POS => County:St. George
                $zone = '1';
                return $zone;
                break;

            case 'sfd':
                // San Fernando => County:Victoria
                $zone = '5';
                return $zone;
                break;

            case 'arm':
                // Arima => County:St. George
                $zone = '1';
                return $zone;
                break;

            default:
                // Return same value entered
                return $value;
                break;
        }
    }

    public function getAgeAtAD($startDate, $endDate)
    {
        $startDate = Carbon::parse($startDate);
        $endDate = Carbon::parse($endDate);

        $diff = $startDate->diff($endDate);

        $yearsDiff = $diff->y;
        $monthsDiff = $diff->m;
        $daysDiff = $diff->d;

        $response = [
            'years' => $yearsDiff,
            'months' => $monthsDiff,
            'days' => $daysDiff,
        ];


        return $response;
    }

    public function daysDifference($startDate, $endDate)
    {

        $startDate = Carbon::parse($startDate);
        $endDate = Carbon::parse($endDate);

        $diffInDays = $startDate->diffInDays($endDate);
        $diffInDays = $diffInDays + 1;

        return $diffInDays;
    }

    public function getAgeGroup($age)
    {
        $years = $age['years'];
        $months = $age['months'];
        $days = $age['days'];
        $ageGroups = adAgeGroups::all();

        if ($years <= 0 && $months <= 0) {
            return 1;
        } elseif ($years <= 0 && $months >= 1) {
            return 2;
        } else {
            foreach ($ageGroups as $ageGroup) {
                if ($years >= $ageGroup->agYearsMin && $years <= $ageGroup->agYearsMax) {
                    return $ageGroup->agID;
                }
            }
            return 20;
        }
    }

    public function view($year, $page){

        $recordCount = adPatientRecord::whereYear('adCreatedDate', '=', $year)->count();

        
        $remainder = $recordCount % 5000;
        if ($remainder >= 1){
            $pages = (intval($recordCount / 5000) + 1);
        }else{
            $pages = intval($recordCount / 5000) ;
        }
        
        $skip = ($page - 1) * 5000;
        
        $records = adPatientRecord::select(
            'adPatientRecord.*',
            'adPatientRecordBatch.btID',
            'adPatientRecordBatch.btNumber',
            'adPatientRecordBatch.btHospitalID',
            'adHospitals.hsID',
            'adHospitals.hsTypeID',
            'adHospitals.hsTitle'
        )
            ->join('adPatientRecordBatch', 'adPatientRecord.adBatchID', '=', 'adPatientRecordBatch.btID')
            ->join('adHospitals', 'adPatientRecordBatch.btHospitalID', '=', 'adHospitals.hsID')
            ->whereYear('adCreatedDate', $year)
            ->orderBy('adCreatedDate', 'desc')
            ->skip($skip)
            ->take(5000)
            ->get();

        $variables = compact('records', 'recordCount', 'page', 'year');
        return view('records', $variables);
    }

    public function update(Request $request, $id)
    {
	try{
		//If a change is made to the batch record, validation is done to ensure new batch number is unique
        $previous = adPatientRecord::find($id);
        $batchid = $previous->adBatchID;
        $previousRegNo = $previous->adRegistrationNo;
        $newRegNo = $request->input('adRegistrationNo');


        //Set time for last updated
        $lastUpdated = Carbon::now();
        $lastUpdated = $lastUpdated->format('Y-m-d H:i:s');

        //Set value for adDateOfBirthUnknown depending on if checkbox is selected
        $adDateOfBirthUnknown = $request->has('adDateOfBirthUnknown') ? 1 : 0;

        //Check if 'No Date of Birth' checkbox is selected
        $noDOB = $request->has('nodobCheckbox') ? 1 : 0;

        //Set estimated Date of Birth
        if ($noDOB == '1' && $adDateOfBirthUnknown == '0') {

            $years = $request->input('estimatedDOB');
            $today = Carbon::now();
            $estimatedDOB = $today->subYears($years);
            $estimatedDOB = $estimatedDOB->format('Y-m-d');
            $dobADR = $estimatedDOB;
            $isEstimated = 1;
        } else {
            $dobADR = $request->input('adDateOfBirth'); //DOB is unchanged if there is no estimated DOB
            $isEstimated = 0;
        }

        $adAddress_TownID = $this->getAddressTownID($request->input('adAddress_ZoneID'));

        $adAddress_ZoneID = $this->getAddressZoneID($request->input('adAddress_ZoneID'));

        //Set value for adExceptionalCase depending on if checkbox is selected
        $adExceptionalCase = $request->has('adExceptionalCase') ? 1 : 0;

        //Set adAge attributes
        $ageAtAdmission = $this->getAgeAtAD($request->input('adDateOfBirth'), $request->input('adDateOfAdmission'));
        $adAgeAdmission_Years = $ageAtAdmission['years'];
        $adAgeAdmission_Months = $ageAtAdmission['months'];
        $adAgeAdmission_Days = $ageAtAdmission['days'];


        $ageAtDischarge = $this->getAgeAtAD($request->input('adDateOfBirth'), $request->input('adDateOfDischarge'));
        $adAgeDischarge_Years = $ageAtDischarge['years'];
        $adAgeDischarge_Months = $ageAtDischarge['months'];
        $adAgeDischarge_Days = $ageAtDischarge['days'];

        //Set AgeGroup
        $ageGroup = $this->getAgeGroup($ageAtAdmission);

        //Length of stay
        $adLengthOfStay = $this->daysDifference($request->input('adDateOfAdmission'), $request->input('adDateOfDischarge'));



        //Validate data if it is NOT an exceptional case
        if ($adExceptionalCase == 0) {
            //Validation
            $rules = [
                'adRegistrationNo' => 'required',
                'adDateOfAdmission' => 'required',
                'adDateOfDischarge' => 'required',
                'adDiagnosis1_Block' => ['required', new GenderDiagnosis, new AgeDiagnosis, new InvalidDiagnosisCode],
                'ecode' => [new MissingECode, new InvalidECode],
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                // If validation fails, redirect back to the form with errors with the input
                return redirect()->route('editadrecords', ['id' => $id])->withErrors($validator)->withInput();
            }
        }

        adPatientRecord::where('adID', $id)->update([
            'adRegistrationNo' => $request->input('adRegistrationNo'),
            'adSerialID' => $request->input('adSerialID'),
            'adAddress_TownID' => $adAddress_TownID,
            'adAddress_ZoneID' => $adAddress_ZoneID,
            'adMaritalStatusID' => $request->input('adMaritalStatusID'),
            'adSexID' => $request->input('adSexID'),
            'adEthnicityID' => $request->input('adEthnicityID'),
            'adDateOfBirth' => $dobADR,
            'adDateOfBirthEstimated' => $isEstimated,
            'adDateOfBirthUnknown' => $adDateOfBirthUnknown,
            'adAgeAdmission_Years' => $adAgeAdmission_Years,
            'adAgeAdmission_Months' => $adAgeAdmission_Months,
            'adAgeAdmission_Days' => $adAgeAdmission_Days,
            'adAgeDischarge_Years' => $adAgeDischarge_Years,
            'adAgeDischarge_Months' => $adAgeDischarge_Months,
            'adAgeDischarge_Days' => $adAgeDischarge_Days,
            'adAgeGroup' => $ageGroup,
            'adLengthOfStay' => $adLengthOfStay,
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


        return redirect()->route('viewbatchrecords', ['id' => $batchid])->with('success', 'Batch entered successfully.');
	} catch (\Exception $exception) {
				dd($exception->getMessage());
	}

        
    }
}
