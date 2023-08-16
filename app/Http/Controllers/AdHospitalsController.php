<?php

namespace App\Http\Controllers;

use App\Models\adHospitals;
use App\Models\adHospitalType;
use Illuminate\Http\Request;

class AdHospitalsController extends Controller
{
    public function index(){

        // $hospitals = adHospitals::all(); // Retrieve all users from the database
        $hospitals = adHospitals::select('adHospitals.*', 'adHospitalType.htTitle as htTitle')
        ->join('adHospitalType', 'adHospitals.hsTypeID', '=', 'adHospitalType.htID')
        ->get();

        return view('hospitals', ['hospitals' => $hospitals]);
    }

    public function edit($id){
        // $hospitals = adHospitals::where('hsID', $id)->get();
        $hospitals = adHospitals::select('adHospitals.*', 'adHospitalType.htTitle as htTitle', 'adHospitalType.htID as htID')
        ->join('adHospitalType', 'adHospitals.hsTypeID', '=', 'adHospitalType.htID')
        ->where('adHospitals.hsID',$id)
        ->get();

        $hTypes = adHospitalType::all();


        return view('edithospitals', ['hospitals' => $hospitals], ['hTypes' => $hTypes]);
    }

    public function update(Request $request, $id)
{
    adHospitals::where('hsID', $id)->update([
        'hsTitle' => $request->input('hsTitle'),
        'hsCode' => $request->input('hsCode'),
        'hsTypeID' => $request->input('hsTypeID'),
    ]);

    return redirect()->route('hospitals')->with('success', 'Hospital updated successfully.');
}
}
