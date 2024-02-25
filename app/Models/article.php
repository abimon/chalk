<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class article extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'category',
        'body',
        'slug',
        'author'
    ];

    public function author(){
        return $this->belongsTo(User::class, 'id', 'author');
    }
    public function comments()
    {
        return $this->hasMany(comments::class, 'id', 'post_id');
    }
    public function likes()
    {
        return $this->hasMany(likes::class, 'id', 'post_id');
    }
    public function views()
    {
        return $this->hasMany(viewer::class, 'id', 'post_id');
    }
}
