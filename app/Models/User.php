<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'level_education',
        'provincial_origin',
        'wa_number',
        'institusi',
        'profile_picture',
        'age',
        'subteam',
        'team_id',
        'identifier'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    //teams
    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    //partisipan_webinar
    public function webinars()
    {
        return $this->belongsToMany(Webinar::class, 'partisipant_webinar', 'user_id', 'webinar_id');
    }

    // bootcamp_user
    public function bootcamps()
    {
        return $this->belongsToMany(Bootcamp::class,'bootcamp_participant', 'user_id', 'bootcamp_id');
    }


    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
