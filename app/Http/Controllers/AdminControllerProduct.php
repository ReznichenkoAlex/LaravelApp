<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminRequestProduct;
use App\Models\Product;
use Image;


class AdminControllerProduct extends AdminController
{
    public function index()
    {
        $products = Product::query()->orderByDesc('id')->paginate(config('myConfig.db_retrieve_count.paginate.admin.product'));
        return view('admin.products', ['products' => $products]);
    }

    public function read(AdminRequestProduct $request)
    {
        $product_id = $request->product_id;
        $product = Product::query()->find($product_id);
        return view('admin.product_update', ['product' => $product, 'id' => $product_id]);
    }

    public function create(AdminRequestProduct $request)
    {
        $name = $request->name;
        $category_id = $request->category_id;
        $price = $request->price;
        $description = $request->description;
        $file = $_FILES;
        $document_root = $_SERVER['DOCUMENT_ROOT'];
        $newName = '/img/cover/' . 'cover-' . $name . '.jpg';
        $pathToSave = $document_root . $newName;
        Image::make($file['image']['tmp_name'])
            ->resize(616, 353)
            ->save($pathToSave);
        Product::query()->create([
            'name' => $name,
            'category_id' => $category_id,
            'price' => $price,
            'description' => $description,
            'image' => $newName
        ]);
        return redirect()->action([AdminControllerProduct::class, 'index'])->with('status',
            config('myConfig.redirect.admin.product.created'));
    }

    public function update(AdminRequestProduct $request)
    {
        $product_id = $request->id;
        $newName = $request->name;
        $newCategory_id = $request->category_id;
        $newPrice = $request->price;
        $newDescription = $request->description;
        $updatedProduct = Product::query()->find($product_id);
        $document_root = $_SERVER['DOCUMENT_ROOT'];
        $newFile = $_FILES;
        if ($newFile) {
            $oldImage = $document_root . $updatedProduct->image;
            if (file_exists($oldImage)) {
                unlink($oldImage);
            }
            $imagePath = '/img/cover/' . 'cover-' . $newName . '.jpg';
            $pathToSave = $document_root . $imagePath;
            Image::make($newFile['image']['tmp_name'])
                ->resize(config('myConfig.imageSize.product.width'), config('myConfig.imageSize.product.height'))
                ->save($pathToSave);
            $updatedProduct->image = $imagePath;
        }
        $updatedProduct->name = $newName;
        $updatedProduct->category_id = $newCategory_id;
        $updatedProduct->price = $newPrice;
        $updatedProduct->description = $newDescription;
        $updatedProduct->save();
        return redirect()->action([AdminControllerProduct::class, 'index'])->with('status',
            config('myConfig.redirect.admin.product.updated'));
    }

    public function delete(AdminRequestProduct $request)
    {
        $product_id = $request->product_id;
        $product = Product::query()->find($product_id);
        $document_root = $_SERVER['DOCUMENT_ROOT'];
        $imagePath = $document_root . $product->image;
        unlink($imagePath);
        $product->delete();
        return redirect()->action([AdminControllerProduct::class, 'index'])->with('status',
            config('myConfig.redirect.admin.product.deleted'));
    }
}
