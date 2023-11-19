<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function categories (){
    return $this->belongsToMany(Category::class,'category_words');
    }

    public function language(){
    return $this->belongsTo(Language::class);

    }

}
