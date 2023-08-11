<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class adEthnicity extends Model
{
    use HasFactory;

    protected $fillable = [
        'etID',
        'etIMPS_ID',
        'etTitle',
    ];
}
