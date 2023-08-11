<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class adSex extends Model
{
    use HasFactory;

    protected $fillable = [
        'sxID',
        'sxIMPS_ID',
        'sxTitle',
    ];
}
