<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminRequestCategory;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminControllerCategories extends AdminController
{
    public function showCategories(Category $model)
    {
        $categories = $model->query()->paginate(config('myConfig.db_retrieve_count.paginate.admin.category'));
        return view('admin.categories' , ['categories' => $categories]);
    }

    public function read(AdminRequestCategory $request)
    {
        $category_id = $request->category_id;
        $category = Category::query()->find($category_id);
        return view('admin.category_update' , ['category' => $category , 'id' => $category_id]);
    }

    public function create(AdminRequestCategory $request)
    {
        $category = $request->category;
        $description = $request->description;
        Category::query()->create([
            'name' => $category,
            'description' => $description]);
        return redirect()->action([AdminControllerCategories::class, 'showCategories'])->with('status', config('myConfig.redirect.admin.category.created'));
    }

    public function update(AdminRequestCategory $request)
    {
        $newName = $request->category;
        $newDescription = $request->description;
        $category_id = $request->id;
        $updatedCategory = Category::query()->find($category_id);
        $updatedCategory->name = $newName;
        $updatedCategory->description = $newDescription;
        $updatedCategory->save();
        return redirect()->action([AdminControllerCategories::class, 'showCategories'])->with('status', config('myConfig.redirect.admin.category.updated'));
    }

    public function delete(AdminRequestCategory $request)
    {
        $category_id = $request->category_id;
        Category::destroy($category_id);
        return redirect()->action([AdminControllerCategories::class, 'showCategories'])->with('status', config('myConfig.redirect.admin.category.deleted'));
    }
}
