<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class adSerial extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'adSerial';

    protected $primaryKey = 'srID';

    protected $fillable = [
        'srID',
        'srIMPS_ID',
        'srTitle',
    ];
}
