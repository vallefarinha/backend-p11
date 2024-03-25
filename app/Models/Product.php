<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded =  [];

    public function order_detail(){
        return $this->hasMany(OrderDetail::class);
    }


    public function image(){
        return $this->hasMany(Image::class);
    }


};
