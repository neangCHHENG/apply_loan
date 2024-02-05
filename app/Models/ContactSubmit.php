<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactSubmit extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'name',
        'email',
        'subject',
        'message',
        'thumbnail',
        'fileCv'
    ];
}
