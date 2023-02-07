<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class SubCategoryController extends Controller
{
    public function allSubCategory(): Factory|View|Application
    {
        $subCategories = SubCategory::latest()->get();
        return view('backend.subcategory.subcategory_all', compact('subCategories'));
    }

    public function addSubCategory(): Factory|View|Application
    {
        $categories = Category::latest()->get();
        return view('backend.subcategory.subcategory_add', compact('categories'));
    }

    public function storeSubCategory(Request $request): RedirectResponse
    {
        SubCategory::insert([
            'category_id' => $request->category_id,
            'subcategory_name' => $request->subcategory_name,
            'subcategory_slug' => strtolower(str_replace(' ', '-', $this->vnToStr($request->subcategory_name)))
        ]);

        $notification = [
            'message' => 'Thêm loại sản phẩm con thành công!',
            'alert-type' => 'success'
        ];

        return redirect()->route('all.subcategory')->with($notification);
    }
}