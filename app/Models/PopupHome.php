<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PopupHome extends Model
{
    use HasFactory;
    protected $fillable = ['image', 'url', 'active', 'state'];
}
