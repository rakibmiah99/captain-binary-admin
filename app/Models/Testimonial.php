<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;
use App\Helper;
class Testimonial extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
    protected $guarded = [];
    function scopeFilter(Builder $builder){
        $q = trim(request()->q);
        $builder->orWhere('name', 'LIKE', "%$q%");
        $builder->orWhere('designation', 'LIKE', "%$q%");
        $builder->orWhere('comments', 'LIKE', "%$q%");
        $builder->orderBy('id', 'desc');
    }


    public function getImageAttribute(){
        return $this->img;
    }
}
