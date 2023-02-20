<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
class Admin extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

   protected $table='admins';
   protected $fillable=['nom','email','created_at','updated_at','password','api_token'];
   public function getJWTIdentifier(){
    return $this->getKey();
}
public function getJWTCustomClaims(){
    return [];
}


}
