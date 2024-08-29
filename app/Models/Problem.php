<?php

namespace App\Models;
use App\Observers\ProblemObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
#[ObservedBy([ProblemObserver::class])]
class Problem extends Model
{
    protected $guarded = [];
    public function scopeFilter(Builder $builder){
        $q = request()->q;
        $q = urldecode($q);
        $q = urldecode($q);
        $q = trim($q);
        $builder->orWhere('title', 'LIKE', "%$q%");
        $builder->orWhere('title_bn', 'LIKE', "%$q%");
        $builder->orWhere('difficulty', 'LIKE', "%$q%");
        $builder->orWhere('tags', 'LIKE', "%$q%");
        $builder->orderBy('id', 'desc');
    }

    public function details(){
        return $this->belongsTo(ProblemDetails::class, 'id', 'problem_id');
    }
    public function references(){
        return $this->hasMany(ProblemReference::class, 'problem_id', 'id');
    }

    public function category(){
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function solved(): HasOne
    {
        return $this->hasOne(SolvedProblem::class);
    }
}
