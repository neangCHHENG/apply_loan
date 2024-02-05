<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CareerLevel extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'title_en',
        'title_kh',
        'note',
        'create_by',
        'state'
    ];
}
