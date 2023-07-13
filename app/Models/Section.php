<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Section extends Model
{
    use HasFactory,HasTranslations;
    protected $guarded=[];
    public $translatable = ['name'];

    protected static function booted()
    {
        static::deleted(function ($section) {
            if($section->blogs)$section->blogs()->delete();
        });
    }
    public function blogs()
	{
		return $this->hasMany(Blog::class);
	}
}
