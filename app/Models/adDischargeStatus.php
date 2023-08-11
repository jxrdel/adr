<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class adDischargeStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'dsID',
        'dsIMPS_ID',
        'dsTitle',
    ];
}
