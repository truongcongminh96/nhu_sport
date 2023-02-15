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

    /**
     * @param int $id
     * @return Factory|View|Application
     */
    final public function editBanner(int $id): Factory|View|Application
    {
        $banner = Banner::findOrFail($id);
        return view('backend.banner.banner_edit', compact('banner'));
    }


    final public function updateBanner(Request $request): RedirectResponse
    {
        if ($request->file('banner_image')) {
            $image = $request->file('banner_image');
            $nameGen = hexdec(uniqid('', false)) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(768, 450)->save('upload/banner/' . $nameGen);
            $saveUrl = 'upload/banner/' . $nameGen;

            if (file_exists($request->old_image)) {
                unlink($request->old_image);
            }

            Banner::findOrFail($request->id)->update([
                'banner_title' => $request->banner_title,
                'banner_url' => $request->banner_url,
                'banner_image' => $saveUrl,
            ]);

            $notification = array(
                'message' => 'Banner Updated with image Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('all.banner')->with($notification);
        }

        Banner::findOrFail($request->id)->update([
            'banner_title' => $request->banner_title,
            'banner_url' => $request->banner_url,
        ]);

        $notification = array(
            'message' => 'Banner Updated without image Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.banner')->with($notification);
    }


    /**
     * @param int $id
     * @return RedirectResponse
     */
    final public function deleteBanner(int $id): RedirectResponse
    {
        $banner = Banner::findOrFail($id);
        $img = $banner->banner_image;
        if ($img) unlink($img);

        Banner::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Banner Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
