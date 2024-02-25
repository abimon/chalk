<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cart extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'buyer_id',
        'quantity',
    ];
    public function product(){
        return $this->belongsTo(product::class, 'product_id', 'id');
    }
    public function buyer(){
        return $this->belongsTo(User::class, 'buyer_id', 'id');
    }
}
