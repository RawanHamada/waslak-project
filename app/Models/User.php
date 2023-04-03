<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
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
        'phone_number',
        'email',
        'avatar',
        'fcm_token'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
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

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function member()
    {
        return $this->belongsTo(Membership::class);
    }

    public function techsupport()
    {
         return $this->hasMany(TechnicalSupport::class);
    }

    // public function conversations()
    // {
    //     return $this->belongsToMany(Conversation::class, 'participants')
    //         ->latest('last_message_id')
    //         ->withPivot([
    //             'role', 'joined_at'
    //         ]);
    // }

    // public function sentMessages()
    // {
    //     return $this->hasMany(Message::class, 'user_id', 'id');
    // }

    // public function receivedMessages()
    // {
    //     return $this->belongsToMany(Message::class, 'recipients')
    //         ->withPivot([
    //             'read_at', 'deleted_at',
    //         ]);
    // }




     /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier() {
        return $this->getKey();
    }
     /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims() {
        return [];
    }



    public function address()
    {
        return $this->hasMany(Address::class);
    }
}
