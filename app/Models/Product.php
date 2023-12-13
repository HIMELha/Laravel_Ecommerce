<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function product_images(){
        return $this->hasMany(productImage::class);
    }

    public function Wishlist(){
        return $this->hasMany(Wishlist::class);
    }

}
