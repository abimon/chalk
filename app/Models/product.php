<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_name',
        'path',
        'file_path',
        'price',
        'details',
        'category'
    ];
    public function orders()
    {
        return $this->hasMany(order::class, 'id', 'product_id');
    }
    public function cart(){
        return $this->belongsTo(User::class, 'product_id', 'id');
    }
}
