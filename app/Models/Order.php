<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;



    protected $fillable = ['lat', 'long', 'market_id', 'order_details','address_name','distance','price','status_order','user_id','driver_id','cancelation_reason'];

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function market()
    {
        return $this->belongsTo(Markets::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
