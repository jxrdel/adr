<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class adAgeGroups extends Model
{
    use HasFactory;

    protected $fillable = [
        'agID',
        'agIMPS_AgeGroupID',
        'agTitle',
        'agTitleShort',
    ];
}
