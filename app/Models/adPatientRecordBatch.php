<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class adPatientRecordBatch extends Model
{
    use HasFactory;

    protected $fillable = [
        'btID',
        'btHospitalID',
        'btNumber',
        'btCreated',
        'btLastModified',
    ];
}
