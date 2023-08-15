<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function partner()
	{
		return $this->belongsTo(Partner::class);
	}

    public function user()
	{
		return $this->belongsTo(User::class);
	}
}
