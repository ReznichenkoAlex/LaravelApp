<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 * @package App
 *
 * @property $name
 * @property-read Category $category
 * @property-read $id
 * @property $category_id
 * @property $price
 * @property $description
 */
class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'category_id', 'price', 'description', 'image'];
    private static $cachedProducts = false;

    public static function getCacheCategories()
    {
        if(self::$cachedProducts === false){
            self::$cachedProducts = self::with('category')->orderByDesc('id')->get();
        }

        return self::$cachedProducts;
    }

    public static function resetCache()
    {
        self::$cachedProducts = false;
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }




}
