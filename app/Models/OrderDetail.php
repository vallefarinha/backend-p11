<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

<<<<<<< HEAD
    protected $table = 'OrderDetail';
    protected $primaryKey = ['cart_id', 'product_id'];
    public $incrementing = false;
    protected $guarded =  [];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
=======
    protected $primaryKey = ['cart_id', 'product_id'];
    public $incrementing = false;
>>>>>>> b14085cc09a204c73eed9fa34c020dbeb42c05b5

    public function cart()
    {
        return $this->belongsTo(Cart::class, 'cart_id');
    }
<<<<<<< HEAD
}
=======

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
>>>>>>> b14085cc09a204c73eed9fa34c020dbeb42c05b5
