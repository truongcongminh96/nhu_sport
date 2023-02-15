<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class BannerController extends Controller
{
    /**
     * @return Factory|View|Application
     */
    final public function allBanner(): Factory|View|Application
    {
        $banner = Banner::latest()->get();
        return view('backend.banner.banner_all', compact('banner'));
    }

    /**
     * @return Factory|View|Application
     */
    final public function addBanner(): Factory|View|Application
    {
        return view('backend.banner.banner_add');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    final public function storeBanner(Request $request): RedirectResponse
    {
        $image = $request->file('banner_image');
        $nameGen = hexdec(uniqid('', false)) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(768, 450)->save('upload/banner/' . $nameGen);
        $saveUrl = 'upload/banner/' . $nameGen;

        Banner::insert([
            'banner_title' => $request->banner_title,
            'banner_url' => $request->banner_url,
            'banner_image' => $saveUrl,
        ]);

        $notification = array(
            'message' => 'Banner Inserted Successfully',
            'alert-type' => 'info'
        );
        return redirect()->route('all.banner')->with($notification);
    }
}
