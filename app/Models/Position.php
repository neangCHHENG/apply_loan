<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'title_en',
        'title_kh',
        'description_en',
        'description_kh',
        'department',
        'experience',
        'note',
        'create_by',
        'state'
    ];
}
