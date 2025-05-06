<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Employee;

class Company extends Model
{
    protected $fillable = [
        'name',
        'ceo',
        'address',
        'website',
        'phone',
    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
