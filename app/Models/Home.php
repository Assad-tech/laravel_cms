<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Home extends Model
{
    use HasFactory;
    protected $fillable = [
        'greeting',
        'site_name',
        'banner',
        'slider_image',
        'banner_description',
        'banner_link',
        'link_text',
    ];
}
