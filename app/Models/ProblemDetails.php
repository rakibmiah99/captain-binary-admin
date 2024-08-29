<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProblemDetails extends Model
{
    protected $guarded = [];
    function problemReference():HasMany{
        return $this->hasMany(ProblemReference::class,'problem_id','problem_id');
    }
}
