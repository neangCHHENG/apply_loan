<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoEmbed extends Model
{
    use HasFactory;
    protected $fillable = ['title_kh', 'title_en', 'url', 'description_kh', 'description_en', 'active', 'state'];
}
