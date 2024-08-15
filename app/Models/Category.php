<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;
use App\Helper;
class Category extends \App\Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
    protected $table = "categories";
    protected $guarded = [];

    function scopeFilter(Builder $builder){
        $q = trim(request()->q);
        $builder->orWhere('categoryName_bn', 'LIKE', "%$q%");
        $builder->orWhere('categoryName', 'LIKE', "%$q%");
        $builder->orderBy('id','DESC');
    }



    public function getImageAttribute(){
        return $this->categoryImg;
    }
}
