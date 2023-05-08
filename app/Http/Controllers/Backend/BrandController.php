<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class BrandController extends Controller
{
    /**
     * @return Factory|View|Application
     */
    public function allBrand(): Factory|View|Application
    {
        $brands = Brand::latest()->get();
        return view('backend.brand.brand_all', compact('brands'));
    }

    /**
     * @return Factory|View|Application
     */
    public function addBrand(): Factory|View|Application
    {
        return view('backend.brand.brand_add');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function storeBrand(Request $request): RedirectResponse
    {
        $image = $request->file('brand_image');
        if (!$image) {
            $notification = [
                'message' => 'Vui lòng chọn hình ảnh thương hiệu',
                'alert-type' => 'error'
            ];

            return redirect()->back()->with($notification);
        }

        $generateName = hexdec(uniqid('', false)) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(300, 300)->save('upload/brand/' . $generateName);
        $saveUrl = 'upload/brand/' . $generateName;

        Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_since' => $request->brand_since,
            'brand_address' => $request->brand_address,
            'short_info' => $request->short_info,
            'brand_slug' => strtolower(str_replace(' ', '-', $this->vnToStr($request->brand_name))),
            'brand_image' => $saveUrl
        ]);

        $notification = [
            'message' => 'Thêm thương hệu thành công!',
            'alert-type' => 'success'
        ];

        return redirect()->route('all.brand')->with($notification);
    }

    /**
     * @param int $brandId
     * @return Factory|View|Application
     */
    public function editBrand(int $brandId): Factory|View|Application
    {
        $brand = Brand::findOrFail($brandId);
        return view('backend.brand.brand_edit', compact('brand'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function updateBrand(Request $request): RedirectResponse
    {
        if ($request->file('brand_image')) {
            $image = $request->file('brand_image');

            $generateName = hexdec(uniqid('', false)) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(300, 300)->save('upload/brand/' . $generateName);
            $saveUrl = 'upload/brand/' . $generateName;

            if (file_exists($request->old_image)) unlink($request->old_image);

            Brand::findOrFail($request->id)->update([
                'brand_name' => $request->brand_name,
                'brand_since' => $request->brand_since,
                'brand_address' => $request->brand_address,
                'short_info' => $request->short_info,
                'brand_slug' => strtolower(str_replace(' ', '-', $this->vnToStr($request->brand_name))),
                'brand_image' => $saveUrl
            ]);

        } else {
            Brand::findOrFail($request->id)->update([
                'brand_name' => $request->brand_name,
                'brand_since' => $request->brand_since,
                'brand_address' => $request->brand_address,
                'short_info' => $request->short_info,
                'brand_slug' => strtolower(str_replace(' ', '-', $this->vnToStr($request->brand_name)))
            ]);
        }

        $notification = [
            'message' => 'Cập nhật thành công!',
            'alert-type' => 'success'
        ];
        return redirect()->route('all.brand')->with($notification);
    }

    /**
     * @param int $brandId
     * @return RedirectResponse
     */
    public function deleteBrand(int $brandId): RedirectResponse
    {
        $brand = Brand::findOrFail($brandId);
        if (file_exists($brand->brand_image)) unlink($brand->brand_image);
        $brand->delete();

        $notification = [
            'message' => 'Xóa thành công!',
            'alert-type' => 'success'
        ];
        return redirect()->back()->with($notification);
    }
}
