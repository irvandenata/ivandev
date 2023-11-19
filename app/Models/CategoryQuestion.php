<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryQuestion extends Model
{
    use HasFactory;

    public function questions (){
      return $this->hasMany(Question::class,'category_id' );
    }

      public function history_tests (){
      return $this->hasMany(HistoryTest::class,'category_question_id' );
    }


}
