<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'website_name', 'website_url', 'show_price',
        'page_title', 'meta_keyword', 'meta_description',
        'address', 'phone1', 'phone2', 'email1', 'email2',
        'facebook', 'instagram', 'twitter', 'youtube', 'tiktok', 'snapchat',
    ];
}
