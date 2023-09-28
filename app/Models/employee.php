<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

class Employee extends Model
{
    // Define the table associated with the model
    protected $table = 'employees';

    // Define the fillable fields for mass assignment
    protected $fillable = [
        'first_name',
        'last_name',
        'company_id',
        'email',
        'phone',
        'profile_picture',
    ];

    // Define relationships
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
}
