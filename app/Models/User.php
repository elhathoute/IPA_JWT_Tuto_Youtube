<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

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

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    // override of method abstract

    //the "getJWTIdentifier" method returns the primary key of the current User model instance
    public function getJWTIdentifier(){
        return $this->getKey();
    }

    //return a key value array

    /* By default, the JWT payload includes standard claims
    such as "iss" (issuer), "exp" (expiration time), and "iat" (issued at time).
    The "getJWTCustomClaims" method allows you to add custom claims
    that are relevant to your application. For example,
     you might include a "role" claim to indicate the user's role or permissions within the application.
In this particular case, since an empty array is being returned, no additional custom claims will be added to the JWT payload.*/
    public function getJWTCustomClaims(){
        return [];
    }


}
