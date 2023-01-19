<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class BrandController extends Controller
{
    public function allBrand(): Factory|View|Application
    {
        $brands = Brand::latest()->get();
        return view('backend.brand.brand_all', compact('brands'));
    }

    public function addBrand(): Factory|View|Application
    {
        return view('backend.brand.brand_add');
    }

    public function storeBrand(Request $request)
    {
        $image = $request->file('brand_image');
        $generateName = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(300, 300)->save('upload/brand/' . $generateName);
        $saveUrl = 'upload/brand/' . $generateName;

        Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_slug' => strtolower(str_replace(' ', '-', $this->vnToStr($request->brand_name))),
            'brand_image' => $saveUrl
        ]);

        $notification = [
            'message' => 'Thêm thương hệu thành công!',
            'alert-type' => 'success'
        ];

        return redirect()->route('all.brand')->with($notification);
    }
}
