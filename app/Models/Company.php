<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $fillable = [
        'master_page_img_bg',
        'master_page_entitle',
        'master_page_artitle',
        'master_page_ensubtitle',
        'master_page_arsubtitle',
        'master_page_entext',
        'master_page_artext',
        'limit_offer_endesc',
        'limit_offer_ardesc',
        'overview_entitle',
        'overview_artitle',
        'overview_ensubtitle',
        'overview_arsubtitle',
        'overview_en',
        'overview_ar',
        'image',
        'mission_en',
        'mission_ar',
        'vision_en',
        'vision_ar',
        'facebook',
        'youtube',
        'instagram',
        'best_hotels_en_desc',
        'best_hotels_ar_desc',
        'book_tour_en_desc',
        'book_tour_ar_desc',
        'book_tour_vedio',
        'book_tour_en_title',
        'book_tour_ar_title',
        'book_transport_en_desc',
        'book_transport_ar_desc',
        'book_transport_vedio',
        'book_transport_en_title',
        'book_transport_ar_title',
        'book_img',
        'transport_img'
    ];
}
