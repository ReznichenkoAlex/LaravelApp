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
    public function index()
    {
        $products = Product::with('category')->orderByDesc('id')->get();
        return view('index', ['products' => $products]);
    }

    public function buy(Product $product, User $user)
    {
//        \App\Jobs\CreateOrder::withChain([
//            new \App\Jobs\SendMail($product, $user)
//        ])->dispatch($user, $product);
//        \App\Jobs\SendMail::dispatch($product, $user);
//        \App\Jobs\ReturnResponce::dispatch($product, $user);
        Mail::to(\Auth::user())->queue(new Order($product, $user));
        return view('home', ['product' => $product]);
    }


}
