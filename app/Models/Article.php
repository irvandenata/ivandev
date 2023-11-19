<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    public function category (){
    return $this->belongsTo(ArticleCategory::class);
    }

    public function savedArticle (){
        return $this->hasMany(ArticleSaved::class);
    }

    public function likedArticle (){
        return $this->hasMany(ArticleLiked::class);
    }

}
