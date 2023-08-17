<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class adDischargeStatus extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'adDischargeStatus';

    protected $primaryKey = 'dsID';

    protected $fillable = [
        'dsID',
        'dsIMPS_ID',
        'dsTitle',
    ];
}
