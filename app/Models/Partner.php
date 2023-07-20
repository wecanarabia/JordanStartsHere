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

    protected static function booted()
    {
        static::deleted(function ($partner) {

            if ($partner->branches)$partner->branches()->delete();
            if ($partner->workdays)$partner->workdays()->delete();
            if ($partner->portraits){
                foreach ($partner->portraits as $portrait) {
                    unlink($portrait->image);
                }
                $partner->portraits()->delete();
            }

            if ($partner->landscapes){
                foreach ($partner->landscapes as $landscape) {
                    unlink($landscape->image);
                }
                $partner->landscapes()->delete();
            }
            if ($partner->logo  && \Illuminate\Support\Facades\File::exists($partner->logo)) {
                unlink($partner->logo);
            }
            if ($partner->file  && \Illuminate\Support\Facades\File::exists($partner->file)) {
                unlink($partner->file);
            }
        });
    }

    public function branches()
	{
		return $this->hasMany(Branch::class);
	}

    public function workdays()
	{
		return $this->hasMany(Workday::class);
	}

    public function portraits()
	{
		return $this->hasMany(PortraitImage::class);
	}

    public function landscapes()
	{
		return $this->hasMany(LandscapeImage::class);
	}

    public function subcategories(){

        return $this->belongsToMany(Subcategory::class,'partner_subcategories','partner_id','subcategory_id');
    }



    public function reviews()
{
    return $this->hasMany(Review::class, 'partner_id')->where('status',1)->orderBy('id', 'desc');
}

public function areas()
{
    return $this->hasManyThrough(Area::class, Branch::class);
}

public function cities()
{
    return $this->hasManyThrough(City::class, Area::class);
}

}
