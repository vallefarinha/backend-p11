<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;


    protected $guarded =  [];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

<<<<<<< HEAD
}
=======
}
>>>>>>> b14085cc09a204c73eed9fa34c020dbeb42c05b5
