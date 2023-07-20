<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subcategory extends Model
{
    use HasFactory,HasTranslations;

    protected $guarded=[];
    public $translatable = ['name'];

    public function category()
	{
		return $this->belongsTo(Category::class);
	}

    public function partners()
    {
        return $this->belongsToMany(Partner::class,'partner_subcategories','subcategory_id','partner_id');
    }

}
