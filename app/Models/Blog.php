<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $fillable = [
        'image',
    'en_title',
    'ar_title',
    'en_text',
    'ar_text',
    'blog_date',
    'blog_category_id',
    'active',

    ];
    public function category()
    {
        return $this->belongsTo(Blogs_category::class, 'blog_category_id');
    }

}
