<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Area extends Model
{
    use HasFactory,HasTranslations;

    protected $guarded=[];
    public $translatable = ['name'];

    public function city()
	{
		return $this->belongsTo(City::class);
	}
}
