<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class adICD_Chapters extends Model
{
    use HasFactory;

    protected $fillable = [
        'chID',
        'chNumber',
        'chBlockStart',
        'chBlockEnd',
        'chTitleBlocks',
        'chTitle',
    ];
}
