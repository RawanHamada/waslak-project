<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','lat', 'long', 'name', 'description'];


    public function user()
    {
        return $this->belongsTo(AccessToken::class)->withDefault();
    }

}