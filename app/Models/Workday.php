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
    const WORKDAYS =[['en'=>'Sunday','ar'=>'الأحد','fr'=>'Dimanche','es'=>'Domingo','ru'=>'Воскресенье'],
        ['en'=>'Monday','ar'=>'الأثنين','fr'=>'Lundi','es'=>'Lunes','ru'=>'Понедельник'],
        ['en'=>'Tuesday','ar'=>'الثلاثاء','fr'=>'Mardi','es'=>'Martes','ru'=>'Вторник'],
        ['en'=>'Wednesday','ar'=>'الأربعاء','fr'=>'Mercredi','es'=>'Miércoles','ru'=>'Среда'],
        ['en'=>'Thursday','ar'=>'الخميس','fr'=>'Jeudi','es'=>'Jueves','ru'=>'Четверг'],
        ['en'=>'Friday','ar'=>'الجمعة','fr'=>'Vendredi','es'=>'Viernes','ru'=>'Пятница'],
        ['en'=>'Saturday','ar'=>'السبت','fr'=>'Samedi','es'=>'Sábado','ru'=>'Суббота']
    ];

    public function partner()
	{
		return $this->belongsTo(Partner::class);
	}
}
