<?php

namespace App\Http\Controllers;

use App\Mail\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Product $model)
    {
        $products = $model->with('category')->orderByDesc('id')->paginate(config('myConfig.db_retrieve_count.paginate.index'));
        return view('index', ['products' => $products]);
    }

    public function buy(Product $product, User $user)
    {
        \App\Jobs\CreateOrder::withChain([
            new \App\Jobs\SendMail($product, $user)
        ])->dispatch($user, $product);
        return view('home', ['product' => $product]);
    }


}
