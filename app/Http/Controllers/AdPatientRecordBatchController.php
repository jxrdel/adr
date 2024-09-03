<?php

namespace App\Http\Controllers;

use App\Models\adHospitals;
use Illuminate\Http\Request;
use App\Models\adPatientRecord;
use Carbon\Carbon;

use App\Models\adDepartment;
use App\Models\adDischargeStatus;
use App\Models\adDischargeType;
use App\Models\adEthnicity;
use App\Models\adMaritalStatus;
use App\Models\adResidenceZone;
use App\Models\adSex;
use App\Models\adSerial;
use App\Models\adAgeGroups;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

use Illuminate\Support\Facades\DB;

use App\Models\adPatientRecordBatch;
use App\Rules\AgeDiagnosis;
use App\Rules\GenderDiagnosis;
use App\Rules\InvalidDiagnosisCode;
use App\Rules\InvalidECode;
use App\Rules\MissingECode;

class AdPatientRecordBatchController extends Controller
{
    public function index()
    {

        return view('batches');
    }
	
	
	public function getBatches()
    {
        $query = adPatientRecordBatch::select('adPatientRecordBatch.*', 'adHospitals.hsTitle as hsTitle', 'adHospitals.hsCode as hsCode', DB::raw('COUNT(adPatientRecord.adBatchID) as batch_count'))
            ->leftJoin('adPatientRecord', 'adPatientRecordBatch.btID', '=', 'adPatientRecord.adBatchID')
            ->join('adHospitals', 'adPatientRecordBatch.btHospitalID', '=', 'adHospitals.hsID')
            ->groupBy(
                'adPatientRecordBatch.btID',
                'adPatientRecordBatch.btNumber',
                'adPatientRecordBatch.btHospitalID',
                'adPatientRecordBatch.btCreatedBy',
                'adPatientRecordBatch.btCreatedDate',
                'adPatientRecordBatch.btLastUpdatedBy',
                'adPatientRecordBatch.btLastUpdatedDate',
                'adHospitals.hsTitle',
                'adHospitals.hsCode'
            );

        return datatables($query)->make(true);
    }

    public function edit($id)
    {
        //Retrieves batch info for batch
        $batches = adPatientRecordBatch::select('adPatientRecordBatch.*', 'adHospitals.hsTitle as hsTitle', 'adHospitals.hsIMPS_ID as hsIMPS_ID')
            ->join('adHospitals', 'adPatientRecordBatch.btHospitalID', '=', 'adHospitals.hsID')
            ->where('adPatientRecordBatch.btID', $id)
            ->get();

        //Retrieves hospital info to be able to select hospitals from drop-down
        $hospitals = adHospitals::all();

        return view('editbatch', ['batches' => $batches], ['hospitals' => $hospitals]);
    }

    public function update(Request $request, $id)
    {
        //Gets current time
        $lastUpdated = Carbon::now();
        $lastUpdated = $lastUpdated->format('Y-m-d H:i:s');

        //If a change is made to the batch record, validation is done to ensure new batch number is unique
        $previous = adPatientRecordBatch::find($id);
        $previousbtNumber = $previous->btNumber;
        $newbtNumber = $request->input('btNumber');

        if ($previousbtNumber != $newbtNumber) {
            $request->validate([
                'btNumber' => 'unique:adPatientRecordBatch,btNumber',
            ]);
        }


        adPatientRecordBatch::where('btID', $id)->update([
            'btNumber' => $request->input('btNumber'),
            'btHospitalID' => $request->input('btHospitalID'),
            'btLastUpdatedBy' => $request->input('username'),
            'btLastUpdatedDate' => $lastUpdated,
        ]);

        return redirect()->route('batches')->with('success', 'Batch updated successfully.');
    }

    public function createBatchRecord($batchid)
    {
        $sexes = adSex::all();
        $serials = adSerial::all();
        $rzones = adResidenceZone::all();
        $mstatuses = adMaritalStatus::all();
        $dStatuses = adDischargeStatus::all();
        $dTypes = adDischargeType::all();
        $ethnicities = adEthnicity::all();
        $departments = adDepartment::all();
        $batch = adPatientRecordBatch::find($batchid);
        $batchowner = $batch->btCreatedBy;
        $batchowner = strtolower($batchowner);



        $combined = compact('sexes', 'serials', 'rzones', 'mstatuses', 'dStatuses', 'dTypes', 'ethnicities', 'departments', 'batch', 'batchowner');

        return view('createbatchrecord', $combined);
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

    public function insertBatchRecord(Request $request, $batchid)
    {
		try {$user = $request->input('username');

        $adAddress_TownID = $this->getAddressTownID($request->input('adAddress_ZoneID'));

        $adAddress_ZoneID = $this->getAddressZoneID($request->input('adAddress_ZoneID'));

        //Get current time
        $now = Carbon::now();
        $now = $now->format('Y-m-d H:i:s');

        //Set value for adDateOfBirthUnknown depending on if checkbox is selected
        $adDateOfBirthUnknown = $request->has('adDateOfBirthUnknown') ? 1 : 0;

        //Check if 'No Date of Birth' checkbox is selected
        $noDOB = $request->has('nodobCheckbox') ? 1 : 0;

        //Set value for adExceptionalCase depending on if checkbox is selected
        $adExceptionalCase = $request->has('adExceptionalCase') ? 1 : 0;

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

        // Validation of Registration #
        // $request->validate([
        //     'adRegistrationNo' => 'unique:adPatientRecord,adRegistrationNo',
        // ]);

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
                return redirect()->route('createbatchrecord', ['id' => $batchid])->withErrors($validator)->withInput();
            }
        }

        adPatientRecord::create([
            'adRegistrationNo' => $request->input('adRegistrationNo'),
            'adSerialID' => $request->input('adSerialID'),
            'adBatchID' => $batchid,
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
            'adCauseOfDeath_Block' => $request->input('adCauseOfDeath_Block'),
            'adCauseOfDeath_BlockDetail' => $request->input('adCauseOfDeath_BlockDetail'),
            'adCreatedDate' => $now,
            'adLastUpdatedDate' => $now,
            'adExceptionalCase' => $adExceptionalCase,
            'adExceptionalDesc' => $request->input('adExceptionalDesc'),
            'adCreatedBy' => $user,
            'adLastUpdatedBy' => $user,
        ]);


        return redirect()->route('viewbatchrecords', ['id' => $batchid])->with('success', 'Batch entered successfully.');
        } catch (\Exception $exception) {
            dd($exception->getMessage());
        }
        
    }

    public function insertBatch(Request $request)
    {
        $user = $request->input('username');

        $today = Carbon::now();
        $today = $today->format('Y-m-d H:i:s');

        $request->validate([
            'btNumber' => 'unique:adPatientRecordBatch,btNumber',
        ]);

        adPatientRecordBatch::create([
            'btHospitalID' => $request->input('btHospitalID'),
            'btNumber' => $request->input('btNumber'),
            'btCreatedDate' => $today,
            'btCreatedBy' => $user,
            'btLastUpdatedDate' => $today,
            'btLastUpdatedBy' => $user,
        ]);

        return redirect()->route('batches')->with('success', 'Batch entered successfully.');
    }

    public function createBatch()
    {
        $hospitals = adHospitals::all();

        return view('createbatch', ['hospitals' => $hospitals]);
    }

    public function viewBatchRecords($batchid)
    {
        $records = adPatientRecord::select('adPatientRecord.*', 'adPatientRecordBatch.btNumber as btNumber', 'adHospitals.hsTitle as hsTitle')
            ->join('adPatientRecordBatch', 'adPatientRecord.adBatchID', '=', 'adPatientRecordBatch.btID')
            ->join('adHospitals', 'adPatientRecordBatch.btHospitalID', '=', 'adHospitals.hsID')
            ->where('adPatientRecord.adBatchID', $batchid)
            ->get();

        $recordcount = adPatientRecord::where('adBatchID', $batchid)->count();

        $batch = adPatientRecordBatch::find($batchid);
        $recordcount = adPatientRecord::where('adBatchID', $batchid)->count();
        $batchowner = $batch->btCreatedBy;
		$batchowner = strtolower($batchowner);
        $batchno = $batch->btNumber;

        $combined = compact('records', 'batchid', 'batchno', 'recordcount', 'batchowner', 'recordcount');

        return view('viewbatchrecords', $combined);
    }
}
