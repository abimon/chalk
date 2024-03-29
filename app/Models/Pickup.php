<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pickup extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'contact',
        'location',
        'desc',
        'duration',
        'value',
        'balance',
        'date',
        'isDone'
        ];
}
