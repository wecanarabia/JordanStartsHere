<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartnerSubcategory extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function partner()
	{
		return $this->belongsTo(Partner::class);
	}

    public function subcategory()
	{
		return $this->belongsTo(Subcategory::class);
	}
}
