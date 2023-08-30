<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Page extends Model
{
    use HasFactory,HasTranslations;
    protected $guarded=[];
    public $translatable = ['title','body'];

    public function setImageAttribute($value){
        if ($value){
            $file = $value;
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename =time().mt_rand(1000,9999).'.'.$extension;
            $file->move(base_path('../img/pages/'), $filename);
            $this->attributes['image'] =  'img/pages/'.$filename;
        }
    }

    protected static function booted()
    {
        static::deleted(function ($page) {
                if ($page->image  && \Illuminate\Support\Facades\File::exists($page->image)) {
                unlink($page->image);
            }
        });
    }
}
