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

use Illuminate\Support\Facades\DB;

use App\Models\adPatientRecordBatch;

class AdPatientRecordBatchController extends Controller
{
    public function index(){


        $batches = DB::table('adPatientRecordBatch')
        ->leftJoin('adPatientRecord', 'adPatientRecordBatch.btID', '=', 'adPatientRecord.adBatchID')
        ->join('adHospitals', 'adPatientRecordBatch.btHospitalID', '=', 'adHospitals.hsID')
        ->select('adPatientRecordBatch.*', 'adHospitals.hsTitle as hsTitle', 'adHospitals.hsCode as hsCode', DB::raw('COUNT(adPatientRecord.adBatchID) as batch_count'))
        ->groupBy('adPatientRecordBatch.btID', 'adPatientRecordBatch.btNumber', 'adPatientRecordBatch.btHospitalID', 'adPatientRecordBatch.btCreatedBy', 
        'adPatientRecordBatch.btCreatedDate', 'adPatientRecordBatch.btLastUpdatedBy', 'adPatientRecordBatch.btLastUpdatedDate', 'adHospitals.hsTitle', 'adHospitals.hsCode')
        ->get();

    // $products now contains a list of products with their type and the count of orders for each product

    // You can return $products or use it as needed
    return view('batches', ['batches' => $batches]);
    }

    public function edit($id){
        $batches = adPatientRecordBatch::select('adPatientRecordBatch.*', 'adHospitals.hsTitle as hsTitle', 'adHospitals.hsIMPS_ID as hsIMPS_ID')
        ->join('adHospitals', 'adPatientRecordBatch.btHospitalID', '=', 'adHospitals.hsID')
        ->where('adPatientRecordBatch.btID',$id)
        ->get();

        $hospitals = adHospitals::all();

        return view('editbatch', ['batches' => $batches], ['hospitals' => $hospitals]);
    }

    public function update(Request $request, $id)
        {

            $lastUpdated = Carbon::now();
            $lastUpdated = $lastUpdated->format('Y-m-d H:i:s');

            //If a change is made to the batch record, validation is done to ensure new batch number is unique
            $previous = adPatientRecordBatch::find($id);
            $previousbtNumber = $previous->btNumber;
            $newbtNumber = $request->input('btNumber');

            if ($previousbtNumber != $newbtNumber){
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

        public function createBatchRecord($batchid){
            $sexes = adSex::all();
            $serials = adSerial::all();
            $rzones = adResidenceZone::all();
            $mstatuses = adMaritalStatus::all();
            $dStatuses = adDischargeStatus::all();
            $dTypes = adDischargeType::all();
            $ethnicities = adEthnicity::all();
            $departments = adDepartment::all();
            $batch = adPatientRecordBatch::find($batchid);
            


            $combined = compact('sexes', 'serials', 'rzones', 'mstatuses', 'dStatuses', 'dTypes', 'ethnicities', 'departments', 'batch');

            return view('createbatchrecord', $combined);
        }

    public function insertBatchRecord(Request $request, $batchid){
        $user = 'MOH\jardel.regis';
        // dd($request);
        //Set time for last updated
        $lastUpdated = Carbon::now();
        $lastUpdated = $lastUpdated->format('Y-m-d H:i:s');

        //Set value for adDateOfBirthUnknown depending on if checkbox is selected
        $adDateOfBirthUnknown = $request->has('adDateOfBirthUnknown') ? 1 : 0;

        //Check if 'No Date of Birth' checkbox is selected
        $noDOB = $request->has('nodobCheckbox') ? 1 : 0;

        //Set value for adDateOfBirthUnknown depending on if checkbox is selected
        $adExceptionalCase = $request->has('adExceptionalCase') ? 1 : 0;

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

        

        adPatientRecord::create([
            'adRegistrationNo' => $request->input('adRegistrationNo'),
            'adSerialID' => $request->input('adSerialID'),
            'adBatchID' => $batchid,
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
            'adExceptionalCase' => $adExceptionalCase,
            'adExceptionalDesc' => $request->input('adExceptionalDesc'),
            'adCreatedBy' => $user,
            'adLastUpdatedBy' => $user,
        ]);
        
    
        return redirect()->route('batches')->with('success', 'Hospital updated successfully.');
    }

    public function insertBatch(Request $request){
        $user = 'MOH\jardel.regis';
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

        return redirect()->route('batches')->with('success', 'Hospital updated successfully.');
    }

    public function createBatch(){
        $hospitals = adHospitals::all();

        return view('createbatch', ['hospitals' => $hospitals]);
    }

    public function viewBatchRecords($batchid){
        $records = adPatientRecord::select('adPatientRecord.*', 'adPatientRecordBatch.btNumber as btNumber', 'adHospitals.hsTitle as hsTitle')
        ->join('adPatientRecordBatch', 'adPatientRecord.adBatchID', '=', 'adPatientRecordBatch.btID')
        ->join('adHospitals', 'adPatientRecordBatch.btHospitalID', '=', 'adHospitals.hsID')
        ->where('adPatientRecord.adBatchID',$batchid)
        ->get();



        // $records = adPatientRecord::where('adBatchID', $batchid)->get();

        return view('viewbatchrecords', ['records' => $records]);
    }
}
