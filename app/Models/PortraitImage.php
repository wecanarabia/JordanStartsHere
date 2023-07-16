<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PortraitImage extends Model
{
    use HasFactory;
    protected $guarded=[];


    public function setImageAttribute($value){
        if ($value){
            $file = $value;
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename =time().mt_rand(1000,9999).'.'.$extension;
            $file->move(base_path('../portrait/partners/'), $filename);
            $this->attributes['image'] =  'portrait/partners/'.$filename;
        }
    }

    protected static function booted()
    {
        static::deleted(function ($partner) {
            if ($partner->image  && \Illuminate\Support\Facades\File::exists($partner->image)) {
                unlink($partner->image);
            }
        });
    }

    public function partner()
	{
		return $this->belongsTo(Partner::class);
	}
}
