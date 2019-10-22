<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Blog;

class Categories extends Model
{
    protected $fillable = [
        'id',
        'cat_name',
        'created_at',
        'updated_at'
    ];
    
//    public function blogs()
//    {
//        return $this->hasMany(Blog::class);
//    }
}
