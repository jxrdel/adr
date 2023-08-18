<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class adDepartment extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'adDepartment';

    protected $primaryKey = 'dpID';

    protected $fillable = [
        'dpID',
        'dpIMPS_ID',
        'dpTitle',
    ];
}
