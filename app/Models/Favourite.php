<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

<<<<<<<< HEAD:app/Models/Cart.php


class Cart extends Model
========
class Favourite extends Model
>>>>>>>> b14085cc09a204c73eed9fa34c020dbeb42c05b5:app/Models/Favourite.php
{
    use HasFactory;

    protected $guarded = [];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

<<<<<<<< HEAD:app/Models/Cart.php
    public function order_detail(){
        return $this->hasMany(OrderDetail::class, 'order_id');
========
    public function product()
    {
        return $this->belongsTo(Product::class);
>>>>>>>> b14085cc09a204c73eed9fa34c020dbeb42c05b5:app/Models/Favourite.php
    }
}