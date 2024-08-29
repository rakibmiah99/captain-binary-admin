<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = ['name','email','mobile','msg','status'];
    protected $attributes = [
        'status' => 'pending',
    ];
    public function scopeFilter(Builder $builder){
        $q = request()->q;
        $q = urldecode($q);
        $q = urldecode($q);
        $q = trim($q);

        $builder->orWhere('name', 'LIKE', "%$q%");
        $builder->orWhere('email', 'LIKE', "%$q%");
        $builder->orWhere('mobile', 'LIKE', "%$q%");
        $builder->orWhere('msg', 'LIKE', "%$q%");
        $builder->orWhere('status', 'LIKE', "%$q%");
        $builder->orderBy('id', 'DESC');
    }
}
