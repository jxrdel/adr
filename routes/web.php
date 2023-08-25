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



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/', function () {return view('welcome');})->name('/');
    Route::get('/hospitals', [AdHospitalsController::class, 'index'])->name('hospitals');
    Route::get('/edithospitals/{id}', [AdHospitalsController::class, 'edit'])->name('edithospitals');
    Route::put('/updatehospitals/{id}', [AdHospitalsController::class, 'update'])->name('updatehospitals');
    Route::get('/adrecords', [AdPatientRecordController::class, 'index'])->name('adrecords');
    Route::get('/editadrecords/{id}', [AdPatientRecordController::class, 'edit'])->name('editadrecords');
    Route::put('/updateadrecords/{id}', [AdPatientRecordController::class, 'update'])->name('updateadrecords');
    Route::get('/batches', [AdPatientRecordBatchController::class, 'index'])->name('batches');
    Route::get('/editbatch/{id}', [AdPatientRecordBatchController::class, 'edit'])->name('editbatch');
    Route::put('/updatebatch/{id}', [AdPatientRecordBatchController::class, 'update'])->name('updatebatch');
    Route::get('/viewbatchrecords/{id}', [AdPatientRecordBatchController::class, 'viewBatchRecords'])->name('viewbatchrecords');
    Route::get('/createbatchrecord/{id}', [AdPatientRecordBatchController::class, 'createBatchRecord'])->name('createbatchrecord');
    Route::put('/insertBatchRecord/{id}', [AdPatientRecordBatchController::class, 'insertBatchRecord'])->name('insertBatchRecord');
    Route::get('/createbatch', [AdPatientRecordBatchController::class, 'createBatch'])->name('createbatch');
    Route::put('/insertbatch', [AdPatientRecordBatchController::class, 'insertBatch'])->name('insertbatch');
});

require __DIR__.'/auth.php';