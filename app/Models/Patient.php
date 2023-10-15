<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'contact',
        'email',
        'gender',
        'location',
        'age_group',
        'condition',
        'prefered_service',
        'logged_by'
    ];
}
