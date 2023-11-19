<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryTest extends Model
{
    use HasFactory;

    public function category (){
    return $this->belongsTo(CategoryQuestion::class,'category_question_id','id');
    }

    public function user (){
    return $this->belongsTo(User::class,'user_id','id');
    }
}
