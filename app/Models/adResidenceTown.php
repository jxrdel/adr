<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class adResidenceTown extends Model
{
    use HasFactory;

    protected $fillable = [
        'rtID',
        'rtResidenceZoneID',
        'rtTitle',
    ];
}
