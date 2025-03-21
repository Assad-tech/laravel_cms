<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteContent extends Model
{
    use HasFactory;
    protected $fillable = [
        'logo',         // Site Logo
        'email',        // Email
        'address',      // Address
        'copyright',    // Copyright Text
    ];
}
