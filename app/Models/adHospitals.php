<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class adHospitals extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'adHospitals';

    protected $primaryKey = 'hsID';

    protected $fillable = [
        'hsID',
        'hsIMPS_ID',
        'hsTypeID',
        'hsTitle',
        'hsCode',
    ];

    public function hospitalType()
    {
        return $this->belongsTo(adHospitalType::class);
    }
}
