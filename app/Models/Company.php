<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'name',
        'email',
        'logo',
        'website'
    ];

    // Define a relationship with employees (assuming you have an Employee model)
    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
