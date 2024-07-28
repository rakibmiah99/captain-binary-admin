<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class Testimonial extends Model implements HasMedia
{
    use HasFactory, HasTranslations, InteractsWithMedia;
    protected $guarded = [];
    public $translatable = ['name', 'designation', 'comments'];
    function scopeFilter(){

    }
    public function getImageAttribute(){
        return $this->getMedia('*')->first()->original_url ?? null;
    }
}
