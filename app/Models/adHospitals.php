<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class adHospitals extends Model
{
    use HasFactory;

    protected $fillable = [
        'hsID',
        'hsIMPS_ID',
        'hsTypeID',
        'hsTitle',
    ];
}
