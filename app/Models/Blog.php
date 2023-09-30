<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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
    'en_breif',
    'ar_breif'

    ];
    public function category()
    {
        return $this->belongsTo(Blogs_category::class, 'blog_category_id');
    }
    public function getSlugAttribute(): string
    {
        // if( LaravelLocalization::getCurrentLocale() === "en"){
        //     return str_slug($this->en_title);

        // }else{
        //     //  return urlencode($this->ar_title);
        //      return rawurlencode($this->ar_title);
        //     //  return Str::slug($this->ar_title)==""?strtolower(urlencode($this->ar_title)):Str::slug($this->ar_title);

        // }

        return str_slug($this->en_title);
    }
}
