<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Markets extends Model
{
    use HasFactory;

    protected $fillable = ['lat', 'long', 'name', 'description','image'];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
