<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property-read $id
 * @property-read $name
 * @property-read $description
 * @property-read Product $products
 */

class Category extends Model
{

    use HasFactory;

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
