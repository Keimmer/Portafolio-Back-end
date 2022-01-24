<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
    use HasFactory;

    protected $fillable = [
        'gendername',
    ];

    public function Users()
    {
        return $this->hasMany('App\User', 'gender_id', 'id');
    }
}
