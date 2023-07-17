<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory,HasTranslations;

    protected $guarded=[];
    public $translatable = ['content'];

    public function partner()
	{
		return $this->belongsTo(Partner::class);
	}

    public function user()
	{
		return $this->belongsTo(User::class);
	}
}
