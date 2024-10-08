<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdHospitalsController;
use App\Http\Controllers\AdPatientRecordBatchController;
use App\Http\Controllers\AdPatientRecordController;
use App\Models\adPatientRecordBatch;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('/');
Route::get('/hospitals', [AdHospitalsController::class, 'index'])->name('hospitals');
Route::get('/edithospitals/{id}', [AdHospitalsController::class, 'edit'])->name('edithospitals');
Route::put('/updatehospitals/{id}', [AdHospitalsController::class, 'update'])->name('updatehospitals');
Route::get('/adrecords', [AdPatientRecordController::class, 'index'])->name('adrecords');
Route::get('/editadrecords/{id}', [AdPatientRecordController::class, 'edit'])->name('editadrecords');
Route::put('/updateadrecords/{id}', [AdPatientRecordController::class, 'update'])->name('updateadrecords');
Route::get('/batches', [AdPatientRecordBatchController::class, 'index'])->name('batches');
Route::get('/getbatches', [AdPatientRecordBatchController::class, 'getBatches'])->name('getbatches');
Route::get('/editbatch/{id}', [AdPatientRecordBatchController::class, 'edit'])->name('editbatch');
Route::put('/updatebatch/{id}', [AdPatientRecordBatchController::class, 'update'])->name('updatebatch');
Route::get('/viewbatchrecords/{id}', [AdPatientRecordBatchController::class, 'viewBatchRecords'])->name('viewbatchrecords');
Route::get('/createbatchrecord/{id}', [AdPatientRecordBatchController::class, 'createBatchRecord'])->name('createbatchrecord');
Route::put('/insertBatchRecord/{id}', [AdPatientRecordBatchController::class, 'insertBatchRecord'])->name('insertBatchRecord');
Route::get('/createbatch', [AdPatientRecordBatchController::class, 'createBatch'])->name('createbatch');
Route::put('/insertbatch', [AdPatientRecordBatchController::class, 'insertBatch'])->name('insertbatch');
Route::get('/records/{year}/page/{page}', [AdPatientRecordController::class, 'view'])->name('records');