<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupWord extends Model
{
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function words()
    {
        return $this->hasMany(OwnWord::class, 'group_id');
    }
    public function results()
    {
        return $this->hasMany(TestResult::class);
    }
}
