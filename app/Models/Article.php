<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'title_en',
        'title_kh',
        'slug_kh',
        'slug_en',
        'feature',
        'note',
        'introduction_kh',
        'introduction_en',
        'thumbnail',
        'meta_content_kh',
        'meta_keyword_kh',
        'meta_content_en',
        'meta_keyword_en',
        'access',
        'relate_article',
        'parent_tag_id',
        'parent_category_id',
        'article_editor_en',
        'article_editor_kh',
        'ordering',
        'schedule',
        'state',
        'thumbnailimgBack'
    ];

    public function category()
    {
        return $this->belongsTo(CategoryArticle::class, 'parent_category_id');
    }
    public function menu()
    {
        return $this->hasMany(Menu::class, 'reference_id');
    }
}
