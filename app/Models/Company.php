<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'title_en',
        'title_kh',
        'external_url',
        'facebook_url',
        'thumbnail',
        'description_en',
        'description_kh',
        'note',
        'create_by',
        'state',
        'department'
    ];
}
