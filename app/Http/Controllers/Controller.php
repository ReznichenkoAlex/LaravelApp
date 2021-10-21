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

    public function index(Product $model)
    {
        $products = $model->with('category')->orderByDesc('id')->paginate(config('myConfig.db_retrieve_count.paginate.index'));
        return view('index', ['products' => $products]);
    }

    public function product(Product $product)
    {
        return view('1product', ['product' => $product]);
    }

    public function category(Category $category)
    {
        $id = $category->id;
        $name = $category->name;
        $products = Product::query()
            ->where('category_id', $id)
            ->orderByDesc('id')
            ->paginate(config('myConfig.db_retrieve_count.paginate.category'));
        return view('category', ['category_name' => $name,'products' => $products]);
    }

    public function news()
    {
        return view('news');
    }

    public function about(Product $model)
    {
        $products = $model->with('category')->inRandomOrder()->limit(config('myConfig.db_retrieve_count.limit.about'))->get();
        return view('about', ['products' => $products]);
    }

}
