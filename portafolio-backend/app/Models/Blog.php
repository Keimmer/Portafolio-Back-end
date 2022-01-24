<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{

    protected $fillable = [
        'blogtitle',
        'user_id',
        'image_id',
    ];

    public function Users()
    {
        return $this->hasMany('App\User', 'user_id', 'id');
    }

    public function Image()
    {
        return $this->hasMany('App\Image', 'image_id', 'id');
    }

    use HasFactory;
}