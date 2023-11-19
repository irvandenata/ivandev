<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'activity_id',
        'category',
    ];
    public function activity (){
    return $this->belongsTo(Activity::class);
    }
}
