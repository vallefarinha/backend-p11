<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

<<<<<<< HEAD
    public function order_detail(){
        return $this->hasMany(OrderDetail::class);
    }


    public function image(){
        return $this->hasMany(Image::class);
    }


};
=======
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }
}
>>>>>>> b14085cc09a204c73eed9fa34c020dbeb42c05b5
