<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id',
        'menu_id',
        'menu_en',
        'menu_kh',
        'slug',
        'position',
        'type',
        'menu_type',
        'link',
        'left',
        'right',
        'is_root',
        'level',
        'reference_id',
        'param1',
        'param2',
        'created_by',
        'updated_by',
        'state',
    ];
    public function article()
    {
        return $this->belongsTo(Article::class, 'reference_id');
    }
}
