<?php

namespace App\Models;

use App\Observers\ProblemObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy([ProblemObserver::class])]
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
        return $this->hasMany(ProblemReference::class, 'problem_id', 'id');
    }

    public function category(){
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
