<?php

namespace App\Models;
use App\Models\OrderDetail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $guarded =  [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function order_details(){
        return $this->hasMany(OrderDetail::class, 'cart_id');
    }
}