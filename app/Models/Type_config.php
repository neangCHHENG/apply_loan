<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type_config extends Model
{
    use HasFactory;
    protected $fillable = ['group_name', 'name', 'type', 'description', 'config_value', 'state'];
}
