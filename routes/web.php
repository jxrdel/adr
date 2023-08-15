<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdHospitalsController;

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

Route::get('/hospitals', [AdHospitalsController::class, 'index'])->name('hospitals');
Route::get('/edithospitals/{id}', [AdHospitalsController::class, 'edit'])->name('edithospitals');
Route::put('/updatehospitals/{id}', [AdHospitalsController::class, 'update'])->name('updatehospitals');

Route::get('/', function () {
    return view('welcome');
});
