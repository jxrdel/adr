<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class adPatientRecordBatch extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'adPatientRecordBatch';

    protected $primaryKey = 'btID';

    protected $fillable = [
        'btID',
        'btHospitalID',
        'btNumber',
        'btCreatedBy',
        'btCreatedDate',
        'btLastUpdatedBy',
        'btLastUpdatedDate',
    ];
}
