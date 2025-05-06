<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'passport_number',
        'first_name',
        'last_name',
        'father_name',
        'position',
        'phone',
        'address',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
