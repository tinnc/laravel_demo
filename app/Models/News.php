<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table =  'news';

    public function category()
    {
        return $this->belongsTo(NewsCategory::class,'category_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id', 'id');
    }
}
