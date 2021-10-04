<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
        $products = Product::with('category')->orderByDesc('id')->get();
        return view('index', ['products' => $products]);
    }

    public function product(Product $product)
    {
        return view('1product', ['product' => $product]);
    }

    public function category(Category $category)
    {
        $products = $category::with('products')
            ->find($category->id)
            ->products;
        return view('category', ['category_name' => $category->name,'products' => $products]);
    }

    public function news()
    {
        return view('news');
    }

    public function about()
    {
        $products = Product::with('category')->inRandomOrder()->limit(3)->get();
        return view('about', ['products' => $products]);
    }

}
