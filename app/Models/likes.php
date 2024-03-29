<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class likes extends Model
{
    use HasFactory;
    protected $fillable =[
        'user_id',
        'post_id'
    ];
    public function article(){
        return $this->belongsTo(article::class, 'id', 'author');
    }
}
