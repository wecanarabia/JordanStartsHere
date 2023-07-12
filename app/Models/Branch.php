<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Branch extends Model
{
    use HasFactory,HasTranslations;

    protected $guarded=[];
    public $translatable = ['name'];

    public function partner()
	{
		return $this->belongsTo(Partner::class);
	}

    public function area()
	{
		return $this->belongsTo(Area::class);
	}
}
