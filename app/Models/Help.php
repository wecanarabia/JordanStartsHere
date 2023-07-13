<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Help extends Model
{
    use HasFactory,HasTranslations;
    protected $guarded=[];
    public $translatable = ['agency'];

    public function setLogoAttribute($value){
        if ($value){
            $file = $value;
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename =time().mt_rand(1000,9999).'.'.$extension;
            $file->move(base_path('../logo/helps/'), $filename);
            $this->attributes['logo'] =  'logo/helps/'.$filename;
        }
    }

 protected static function booted()
    {
        static::deleted(function ($emergency) {
                if ($emergency->logo  && \Illuminate\Support\Facades\File::exists($emergency->logo)) {
                unlink($emergency->logo);
            }
        });
    }   
}
