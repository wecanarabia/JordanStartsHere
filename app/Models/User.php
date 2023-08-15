<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $guarded=[];
    protected $fillable = [
        'name','last_name','email', 'password','phone','profile_image_id','active','otp','lat','long'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    public function profile()
    {
        return $this->belongsTo(ProfileImage::class,'profile_image_id','id');
    }

    public function favorites(){
        return $this->belongsToMany(Partner::class,'favorites','user_id','partner_id');
    }

    public function reviews(){
        return $this->HasMany(Review::class);
    }

    protected static function booted()
    {
        static::deleted(function ($user) {


            if ($user->favorites()->count()>0)$user->favorites()->detach();
            if ($user->reviews)$user->reviews()->delete();

        });
    }


}
