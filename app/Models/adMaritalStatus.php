<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class adMaritalStatus extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'adMaritalStatus';

    protected $primaryKey = 'msID';

    protected $fillable = [
        'msID',
        'msIMPS_ID',
        'msTitle',
    ];
}
