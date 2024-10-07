<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class patientrecord extends Model
{
    use HasFactory;

    protected $table = 'patientrecord';

    protected $fillable = [
        'PatientID',
        'LastName',
        'FirstName',
        'MiddleName',
        'Birthdate',
        'Age',
        'Gender',
        'HouseNumber',
        'Street',
        'Barangay',
        'Municipality',
        'Province',
        'ContactNumber',
        'email',
        'PhilhealthNumber',
    ];

    protected $hidden = [
        'email_verified_at',
        'remember_token',
    ];

    protected $casts = [
        'Birthdate' => 'date',
    ];

    public function medicalLogs()
    {
        return $this->hasMany(patientmedicallog::class, 'PatientNumber', 'PatientID');
    }
}
