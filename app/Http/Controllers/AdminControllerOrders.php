<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminRequestOrders;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminControllerOrders extends AdminController
{
    public function index()
    {
        $orders = Order::query()->with('product')->orderByDesc('id')->paginate(config('myConfig.db_retrieve_count.paginate.admin.order'));
        return view('admin.orders' , ['orders' => $orders]);
    }

    public function read(AdminRequestOrders $request)
    {
        $order_id = $request->order_id;
        $order = Order::query()->find($order_id);
        return view('admin.order_update' , ['order' => $order , 'id' => $order_id]);
    }

    public function create(AdminRequestOrders $request)
    {
        $product_id = $request->product_id;
        $user_email = $request->user_email;
        Order::query()->create([
           'product_id' => $product_id,
           'user_email' => $user_email
        ]);
        return redirect()->action([AdminControllerOrders::class, 'index'])->with('status', config('myConfig.redirect.admin.order.created'));
    }

    public function update(AdminRequestOrders $request)
    {
        $newProductID = $request->product_id;
        $newUserEmail = $request->user_email;
        $order_id = $request->id;
        $updatedOrder = Order::query()->find($order_id);
        $updatedOrder->product_id = $newProductID;
        $updatedOrder->user_email = $newUserEmail;
        $updatedOrder->save();
        return redirect()->action([AdminControllerOrders::class, 'index'])->with('status', config('myConfig.redirect.admin.order.updated'));
    }

    public function delete(AdminRequestOrders $request)
    {
        $order_id = $request->order_id;
        Order::destroy($order_id);
        return redirect()->action([AdminControllerOrders::class, 'index'])->with('status', config('myConfig.redirect.admin.order.deleted'));
    }
}
