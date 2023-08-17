<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class adDischargeType extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $table = 'adDischargeType';

    protected $primaryKey = 'dtID';

    protected $fillable = [
        'dtID',
        'dtIMPS_ID',
        'dtTitle',
    ];
}
