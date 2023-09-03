<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    use HasFactory;
    public function setImageAttribute($value){
        if ($value){
            $file = $value;
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename =time().mt_rand(1000,9999).'.'.$extension;
            $file->move(base_path('../img/ads/'), $filename);
            $this->attributes['image'] =  'img/ads/'.$filename;
        }
    }

    protected static function booted()
    {
        static::deleted(function ($ad) {
                if ($ad->image  && \Illuminate\Support\Facades\File::exists($ad->image)) {
                unlink($ad->image);
            }
        });
    }
}
