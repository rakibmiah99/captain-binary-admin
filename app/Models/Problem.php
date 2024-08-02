<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Problem extends Model
{
    use HasFactory;

    protected $guarded = [];
    public function scopeFilter(){
        
    }

    public function details(){
        return $this->belongsTo(ProblemDetail::class, 'id', 'problem_id');
    }
    public function references(){
        return $this->belongsTo(ProblemReference::class, 'id', 'problem_id');
    }
}
