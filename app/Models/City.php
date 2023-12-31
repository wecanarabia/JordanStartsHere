<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class City extends Model
{
    use HasFactory,HasTranslations;
    protected $guarded=[];
    public $translatable = ['name','title_one','title_two'];

    public function setImageAttribute($value){
        if ($value){
            $file = $value;
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename =time().mt_rand(1000,9999).'.'.$extension;
            $file->move(base_path('../img/cities/'), $filename);
            $this->attributes['image'] =  'img/cities/'.$filename;
        }
    }

    protected static function booted()
    {
        static::deleted(function ($city) {
            if($city->areas)$city->areas()->delete();
            if ($city->image  && \Illuminate\Support\Facades\File::exists($city->image)) {
            unlink($city->image);
            }
        });
    }

    public function areas()
	{
		return $this->hasMany(Area::class);
	}
}
