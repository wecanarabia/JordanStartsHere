<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileImage extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function setImageAttribute($value){
        if ($value){
            $file = $value;
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename =time().mt_rand(1000,9999).'.'.$extension;
            $file->move(base_path('../img/profiles/'), $filename);
            $this->attributes['image'] =  'img/profiles/'.$filename;
        }
    }

    protected static function booted()
    {
        static::deleted(function ($profile) {
            if ($profile->image  && \Illuminate\Support\Facades\File::exists($profile->image)) {
                unlink($profile->image);
            }
        });
    }
}
