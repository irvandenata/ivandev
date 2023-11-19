<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    public function options (){
    return $this->hasMany(OptionQuestion::class);
    }

    public function category (){
    return $this->belongsTo(CategoryQuestion::class,'category_id');
    }

    public function solvedQuestion (){
    return $this->hasMany(SolvedQuestion::class,'question_id');
    }
}
