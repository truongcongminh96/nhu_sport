<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class SliderController extends Controller
{
    /**
     * @return Factory|View|Application
     */
    final public function allSlider(): Factory|View|Application
    {
        $sliders = Slider::latest()->get();
        return view('backend.slider.slider_all', compact('sliders'));
    }

    final public function addSlider(): Factory|View|Application
    {
        return view('backend.slider.slider_add');
    }


    final public function StoreSlider(Request $request): RedirectResponse
    {
        $image = $request->file('slider_image');
        $nameGen = hexdec(uniqid('', false)) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(2376, 807)->save('upload/slider/' . $nameGen);
        $saveUrl = 'upload/slider/' . $nameGen;

        Slider::insert([
            'slider_title' => $request->slider_title,
            'short_title' => $request->short_title,
            'slider_image' => $saveUrl,
        ]);

        $notification = array(
            'message' => 'Slider Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.slider')->with($notification);
    }
}
