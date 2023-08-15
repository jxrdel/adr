<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class adHospitalType extends Model
{
    use HasFactory;

    protected $table = 'adHospitalType';

    public function hospitals()
    {
        return $this->hasMany(adHospitals::class);
    }

    protected $fillable = [
        'htID',
        'htTitle',
    ];
}
