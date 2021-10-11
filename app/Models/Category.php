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

    protected $fillable = [
        'name',
        'description',
    ];

    private static $cachedCategories = false;
    private static $cachedCategoryProducts = false;


    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public static function getCacheCategories()
    {
        if (self::$cachedCategories === false){
            self::$cachedCategories = self::query()->get();
        }

        return self::$cachedCategories;
    }

    public static function getCachedCategoryProducts(Category $category)
    {
        if (self::$cachedCategoryProducts === false){
            self::$cachedCategoryProducts = self::with('products')
                ->find($category->id)
                ->products;
        }

        return self::$cachedCategoryProducts;
    }
}
