<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class adResidenceZone extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'adResidenceZone';

    protected $primaryKey = 'rzID';

    protected $fillable = [
        'rzID',
        'rzIMPS_ID',
        'rzTitle',
    ];
}
