<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Workday extends Model
{
    use HasFactory,HasTranslations;

    protected $guarded=[];
    public $translatable = ['day'];

    public function partner()
	{
		return $this->belongsTo(Partner::class);
	}
}
