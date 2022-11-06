<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blogs_category extends Model
{
    use HasFactory;
    protected $fillable = [
        'en_category',
        'ar_category',

    ];

    public function blogs()
    {
        return $this->hasMany(Blog::class,"blog_category_id","id");
    }
}
