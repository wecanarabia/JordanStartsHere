<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Partner extends Model
{
    use HasFactory,HasTranslations;
    protected $guarded=[];
    public $translatable = ['name','description'];

    public function setLogoAttribute($value){
        if ($value){
            $file = $value;
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename =time().mt_rand(1000,9999).'.'.$extension;
            $file->move(base_path('../logo/partners/'), $filename);
            $this->attributes['logo'] =  'logo/partners/'.$filename;
        }
    }

    public function setFileAttribute($value){
        if ($value){
            $file = $value;
            $extension = $file->getClientOriginalExtension(); // getting file extension
            $filename =time().mt_rand(1000,9999).'.'.$extension;
            $file->move(base_path('../file/partners/'), $filename);
            $this->attributes['file'] =  'file/partners/'.$filename;
        }
    }

    public function branches()
	{
		return $this->hasMany(Branch::class);
	}

    public function portraits()
	{
		return $this->hasMany(PortraitImage::class);
	}

    public function landscapes()
	{
		return $this->hasMany(LandscapeImage::class);
	}

}
