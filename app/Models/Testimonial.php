<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $guarded = [];
    function scopeFilter(Builder $builder){
        $q = request()->q;
        $q = urldecode($q);
        $q = urldecode($q);
        $q = trim($q);
        $builder->orWhere('name', 'LIKE', "%$q%");
        $builder->orWhere('designation', 'LIKE', "%$q%");
        $builder->orWhere('comments', 'LIKE', "%$q%");
        $builder->orderBy('id', 'desc');
    }
}
