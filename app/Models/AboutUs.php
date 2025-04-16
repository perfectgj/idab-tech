<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    use HasFactory;

    protected $table = 'about_us';

    protected $fillable = [
        'location',
        'members_count',
        'opening_date',
        'phone',
        'email',
        'urls',
        'title',
        'description',
        'vissions',
    ];

    // Cast JSON columns to array
    protected $casts = [
        'urls' => 'array',
        'vissions' => 'array',
    ];
}
