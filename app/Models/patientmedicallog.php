<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class patientmedicallog extends Model
{
    use HasFactory;

    protected $table = 'patientmedicallog';

    protected $fillable = [
        'PatientNumber',
        'Consultation',
        'Remarks',
        'DateOfConsultation',
        'DateOfUpload',
        'Files',
    ];

    public function patientRecord()
    {
        return $this->belongsTo(patientrecord::class, 'PatientNumber', 'PatientID');
    }
}
