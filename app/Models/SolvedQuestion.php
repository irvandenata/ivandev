<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolvedQuestion extends Model
{
    use HasFactory;

    public function users(){
    return $this->belongsTo(User::class,'user_id','id');
    }

    public function question(){
    return $this->belongsTo(Question::class,'question_id','id');
    }
}
