<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class adResidenceZone extends Model
{
    use HasFactory;

    protected $fillable = [
        'rzID',
        'rzIMPS_ID',
        'rzTitle',
    ];
}
