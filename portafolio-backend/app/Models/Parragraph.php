<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parragraph extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'blog_id',
        'subtitle',
        'parragraph',
        'source',
    ];
    
    public function Blogs()
    {
        return $this->hasMany('App\Blog', 'blog_id', 'id');
    }
    use HasFactory;
}
