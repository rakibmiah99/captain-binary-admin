<?php

namespace App\Models;

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
    function scopeFilter(){

    }
    // public function getImageAttribute(){
    //     return $this->getMedia('*')->first()->original_url ?? null;
    // }
    
    public function getImageAttribute(){
        return $this->img;
        // return Helper::GetImage($this->img);
    }
}
