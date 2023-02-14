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
    /**
     * @return Factory|View|Application
     */
    public function allCategory(): Factory|View|Application
    {
        $categories = Category::latest()->get();
        return view('backend.category.category_all', compact('categories'));
    }

    /**
     * @return Factory|View|Application
     */
    public function addCategory(): Factory|View|Application
    {
        return view('backend.category.category_add');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
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

        $generateName = hexdec(uniqid('', false)) . '.' . $image->getClientOriginalExtension();
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

    /**
     * @param $categoryId
     * @return Factory|View|Application
     */
    public function editCategory($categoryId): Factory|View|Application
    {
        $category = Category::findOrFail($categoryId);
        return view('backend.category.category_edit', compact('category'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function updateCategory(Request $request): RedirectResponse
    {
        if ($request->file('category_image')) {
            $image = $request->file('category_image');

            $generateName = hexdec(uniqid('', false)) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(300, 300)->save('upload/category/' . $generateName);
            $saveUrl = 'upload/category/' . $generateName;

            if (file_exists($request->old_image)) unlink($request->old_image);

            Category::findOrFail($request->id)->update([
                'category_name' => $request->category_name,
                'category_slug' => strtolower(str_replace(' ', '-', $this->vnToStr($request->category_name))),
                'category_image' => $saveUrl
            ]);

        } else {
            Category::findOrFail($request->id)->update([
                'category_name' => $request->category_name,
                'category_slug' => strtolower(str_replace(' ', '-', $this->vnToStr($request->category_name)))
            ]);
        }

        $notification = [
            'message' => 'Cập nhật thành công!',
            'alert-type' => 'success'
        ];
        return redirect()->route('all.category')->with($notification);
    }

    /**
     * @param int $categoryId
     * @return RedirectResponse
     */
    public function deleteCategory(int $categoryId): RedirectResponse
    {
        $category = Category::findOrFail($categoryId);
        if (file_exists($category->category_image)) unlink($category->category_image);
        $category->delete();

        $notification = [
            'message' => 'Xóa thành công!',
            'alert-type' => 'success'
        ];
        return redirect()->back()->with($notification);
    }
}
