<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    use HasFactory;
    protected $fillable = ['key', 'type', 'value_en', 'value_kh', 'image', 'description_en', 'description_kh', 'state'];
}
