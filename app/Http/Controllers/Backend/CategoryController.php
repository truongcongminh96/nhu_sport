<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    public function allCategory(): Factory|View|Application
    {
        $categories = Category::latest()->get();
        return view('backend.category.category_all', compact('categories'));
    }

    public function addCategory(): Factory|View|Application
    {
        return view('backend.category.category_add');
    }

    public function storeCategory(Request $request): RedirectResponse
    {
        $image = $request->file('category_image');
        if (!$image) {
            $notification = [
                'message' => 'Vui lòng chọn hình ảnh loại sản phẩm',
                'alert-type' => 'error'
            ];

            return redirect()->back()->with($notification);
        }

        $generateName = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(300, 300)->save('upload/category/' . $generateName);
        $saveUrl = 'upload/category/' . $generateName;

        Category::insert([
            'category_name' => $request->category_name,
            'category_slug' => strtolower(str_replace(' ', '-', $this->vnToStr($request->category_name))),
            'category_image' => $saveUrl
        ]);

        $notification = [
            'message' => 'Thêm loại sản phẩm thành công!',
            'alert-type' => 'success'
        ];

        return redirect()->route('all.category')->with($notification);
    }
}
