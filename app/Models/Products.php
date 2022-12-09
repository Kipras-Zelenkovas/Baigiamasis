<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $fillable = ['name', 'description', 'price', 'quantity', 'user_id', 'category_id'];

    public function category(){
        return $this->belongsTo(Categories::class, 'id', 'category_id');
    }

    public function images(){
        return $this->hasMany(Products_images::class, 'products_id', 'id');
    }
}
