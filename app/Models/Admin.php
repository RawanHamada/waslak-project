<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;



use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;


class Admin extends Authenticatable
{
    use HasFactory , Notifiable;

    protected $guard = "admin";

    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

      // Accessor Methods
      public function getImageAttribute(){
        if(!$this->avatar) {
            return asset('assets/images/auth/avatar.png');
        }
        return asset('uploads/avatar/' . $this->avatar);

    }
}
