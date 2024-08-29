<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Bookmark extends Model
{
    public function problem(): HasOne
    {
        return $this->hasOne(Problem::class,'id','problem_id');
    }
}
