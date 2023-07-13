<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandscapeImage extends Model
{
    use HasFactory;
    protected $guarded=[];


    public function setImageAttribute($value){
        if ($value){
            $file = $value;
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename =time().mt_rand(1000,9999).'.'.$extension;
            $file->move(public_path('../landscapes/partners/'), $filename);
            $this->attributes['image'] =  'landscapes/partners/'.$filename;
        }
    }

    public function partner()
	{
		return $this->belongsTo(Partner::class);
	}
}
