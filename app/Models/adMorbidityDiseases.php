<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class adMorbidityDiseases extends Model
{
    use HasFactory;

    protected $fillable = [
        'mdID',
        'mdIMPS_TabNo',
        'mdTitle',
    ];
}
