<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminRequestProduct;
use App\Models\Product;
use App\Services\ImageService\SaveImageInterface;


class AdminControllerProduct extends AdminController
{
    public function showProducts(Product $model)
    {
        $products = $model->query()->orderByDesc('id')->paginate(config('myConfig.db_retrieve_count.paginate.admin.product'));
        return view('admin.products', ['products' => $products]);
    }

    public function read(AdminRequestProduct $request)
    {
        $product = Product::query()->find($request->product_id);
        return view('admin.product_update', ['product' => $product, 'id' => $request->product_id]);
    }

    public function create(AdminRequestProduct $request, SaveImageInterface $image)
    {
        $newName = '/img/cover/' . 'cover-' . $request->name . '.jpg';
        $image->saveUploadImage($name);
        Product::query()->create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'price' => $request->$price,
            'description' => $request->$description,
            'image' => $newName
        ]);
        return redirect()->action([AdminControllerProduct::class, 'showProducts'])->with('status',
            config('myConfig.redirect.admin.product.created'));
    }

    public function update(AdminRequestProduct $request, SaveImageInterface $image)
    {
        $updatedProduct = Product::query()->find($request->id);
        if (request()->hasFile('image')) {
            $oldImage = public_path() . $updatedProduct->image;
            if (file_exists($oldImage)) {
                unlink($oldImage);
            }
            $image->saveUploadImage($request->name);
            $imagePath = '/img/cover/' . 'cover-' . $request->name . '.jpg';
            $updatedProduct->image = $imagePath;
        }
        $updatedProduct->name = $request->name;
        $updatedProduct->category_id = $request->category_id;
        $updatedProduct->price = $request->price;
        $updatedProduct->description = $request->description;
        $updatedProduct->save();
        return redirect()->action([AdminControllerProduct::class, 'showProducts'])->with('status',
            config('myConfig.redirect.admin.product.updated'));
    }

    public function delete(AdminRequestProduct $request)
    {
        $product_id = $request->product_id;
        $product = Product::query()->find($product_id);
        $imagePath = public_path() . $product->image;
        unlink($imagePath);
        $product->delete();
        return redirect()->action([AdminControllerProduct::class, 'showProducts'])->with('status',
            config('myConfig.redirect.admin.product.deleted'));
    }
}
