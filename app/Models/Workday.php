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
    const WORKDAYS =[['en'=>'Sunday','ar'=>'الأحد','fr'=>'Dimanche','es'=>'Domingo','ko'=>'일요일'],
        ['en'=>'Monday','ar'=>'الأثنين','fr'=>'Lundi','es'=>'Lunes','ko'=>'월요일'],
        ['en'=>'Tuesday','ar'=>'الثلاثاء','fr'=>'Mardi','es'=>'Martes','ko'=>'화요일'],
        ['en'=>'Wednesday','ar'=>'الأربعاء','fr'=>'Mercredi','es'=>'Miércoles','ko'=>'수요일'],
        ['en'=>'Thursday','ar'=>'الخميس','fr'=>'Jeudi','es'=>'Jueves','ko'=>'목요일'],
        ['en'=>'Friday','ar'=>'الجمعة','fr'=>'Vendredi','es'=>'Viernes','ko'=>'금요일'],
        ['en'=>'Saturday','ar'=>'السبت','fr'=>'Samedi','es'=>'Sábado','ko'=>'토요일']
    ];

    public function partner()
	{
		return $this->belongsTo(Partner::class);
	}
}
