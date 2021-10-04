<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 * @package App
 *
 * @property-read $name
 * @property-read Category $category
 * @property-read $id
 * @property-read $category_id
 * @property-read $price
 * @property-read $description
 */
class Product extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

//    public function order()
//    {
//        return $this->hasMany(Order::class);
//    }

}
