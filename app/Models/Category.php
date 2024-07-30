<?php

namespace App\Models;

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
//    public $incrementing = true;
//    public $timestamps = true;
    // public $translatable = ['name', 'details'];

    function scopeFilter(){

    }

    // public function getImageAttribute(){
    //     return $this->getMedia('*')->first()->original_url ?? null;
    // }

    public function getImageAttribute(){
        return Helper::GetImage($this->categoryImg);
    }
}
