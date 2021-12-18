<?php

namespace App\Models;

use App\Notifications\ResetPassword as ResetPasswordNotification;
use Hash;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use LaratrustUserTrait;
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'country_code',
        'phone',
        'password',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'phone_verified_at' => 'datetime',
    ];

    /**
     * Automatically creates hash for the user password.
     *
     * @param  string  $value
     * @return void
     */

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function sendPasswordResetNotification($token)
    {
        $email = request()->email;
        $redirectUrl = request()->redirect_url;
        $this->notify(new ResetPasswordNotification($token, $redirectUrl, $email));
    }

    public function plans()
    {
        return $this->belongsToMany('users_plans', 'user_id', 'plan_id');
    }

    public function parent_detail()
    {
        return $this->hasOne('App\Models\ParentDetail');
    }

    public function student_detail()
    {
        return $this->hasOne('App\Models\StudentDetail');
    }
}
