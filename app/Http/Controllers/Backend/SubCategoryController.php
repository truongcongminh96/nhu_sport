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
use JsonException;

class SubCategoryController extends Controller
{
    /**
     * @return Factory|View|Application
     */
    final public function allSubCategory(): Factory|View|Application
    {
        $subCategories = SubCategory::latest()->get();
        return view('backend.subcategory.subcategory_all', compact('subCategories'));
    }

    /**
     * @return Factory|View|Application
     */
    final public function addSubCategory(): Factory|View|Application
    {
        $categories = Category::latest()->get();
        return view('backend.subcategory.subcategory_add', compact('categories'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    final public function storeSubCategory(Request $request): RedirectResponse
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

    /**
     * @param $subCategoryId
     * @return Factory|View|Application
     */
    final public function editSubCategory($subCategoryId): Factory|View|Application
    {
        $categories = Category::latest()->get();
        $subCategory = SubCategory::findOrFail($subCategoryId);
        return view('backend.subcategory.subcategory_edit', compact('categories', 'subCategory'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    final public function updateSubCategory(Request $request): RedirectResponse
    {
        SubCategory::findOrFail($request->id)->update([
            'category_id' => $request->category_id,
            'subcategory_name' => $request->subcategory_name,
            'subcategory_slug' => strtolower(str_replace(' ', '-', $this->vnToStr($request->subcategory_name)))
        ]);

        $notification = [
            'message' => 'Cập nhật thành công!',
            'alert-type' => 'success'
        ];
        return redirect()->route('all.subcategory')->with($notification);
    }

    /**
     * @param int $subCategoryId
     * @return RedirectResponse
     */
    final public function deleteSubCategory(int $subCategoryId): RedirectResponse
    {
        SubCategory::findOrFail($subCategoryId)->delete();

        $notification = [
            'message' => 'Xóa thành công!',
            'alert-type' => 'success'
        ];
        return redirect()->back()->with($notification);
    }

    /**
     * @param int $categoryId
     * @return string|false
     * @throws JsonException
     */
    final public function getSubCategory(int $categoryId): string|false
    {
        $subCategory = SubCategory::where(['category_id' => $categoryId])->orderBy('subcategory_name', 'ASC')->get();
        return json_encode($subCategory, JSON_THROW_ON_ERROR);
    }
}
