<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $guarded = [];
    function scopeFilter(Builder $builder){
        $q = request()->q;
        $q = urldecode($q);
        $q = urldecode($q);
        $q = trim($q);
        $builder->orWhere('categoryName_bn', 'LIKE', "%$q%");
        $builder->orWhere('categoryName', 'LIKE', "%$q%");
        $builder->orderBy('id','DESC');
    }
}
