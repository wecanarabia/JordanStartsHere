<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blog extends Model
{
    use HasFactory,HasTranslations;
    protected $guarded=[];
    public $translatable = ['title','description'];

    public function setImageAttribute($value){
        if ($value){
            $file = $value;
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename =time().mt_rand(1000,9999).'.'.$extension;
            $file->move(base_path('../img/blogs/'), $filename);
            $this->attributes['image'] =  'img/blogs/'.$filename;
        }
    }

    protected static function booted()
    {
        static::deleted(function ($blog) {
                if ($blog->image  && \Illuminate\Support\Facades\File::exists($blog->image)) {
                unlink($blog->image);
            }
        });
    }

    public function section()
	{
		return $this->belongsTo(Section::class);
	}
}
