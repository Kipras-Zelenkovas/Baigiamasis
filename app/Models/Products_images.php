<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products_images extends Model
{
    use HasFactory;

    protected $table = 'products_images';
    protected $fillable = ['name', 'products_id'];
}
