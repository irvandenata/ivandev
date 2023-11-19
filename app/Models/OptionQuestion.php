<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OptionQuestion extends Model
{
    use HasFactory;

    protected $guraded = [];
    public function question (){
    return $this->belongsTo(Question::class);
    }
}
