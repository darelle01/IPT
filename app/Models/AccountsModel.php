<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AccountsModel extends Authenticatable
{
    use HasFactory;

    protected $table = 'accounts';

    protected $fillable = [
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
        'email',
        'ContactNumber',
        'Position',
        'Status',
        'ActivityStatus',
        'username',
        'password',
        'profile_picture',
        'OTP',                
        'OTPduration',
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];

    // Optionally, set the casting of attributes
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }
}
