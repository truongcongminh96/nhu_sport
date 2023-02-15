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


    final public function storeSlider(Request $request): RedirectResponse
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

    final public function editSlider(int $id): Factory|View|Application
    {
        $sliders = Slider::findOrFail($id);
        return view('backend.slider.slider_edit', compact('sliders'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    final public function updateSlider(Request $request): RedirectResponse
    {
        if ($request->file('slider_image')) {
            $image = $request->file('slider_image');
            $nameGen = hexdec(uniqid('', false)) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(2376, 807)->save('upload/slider/' . $nameGen);
            $saveUrl = 'upload/slider/' . $nameGen;

            if (file_exists($request->old_image)) {
                unlink($request->old_image);
            }

            Slider::findOrFail($request->id)->update([
                'slider_title' => $request->slider_title,
                'short_title' => $request->short_title,
                'slider_image' => $saveUrl,
            ]);

            $notification = array(
                'message' => 'Slider Updated with image Successfully',
                'alert-type' => 'success'
            );

        } else {

            Slider::findOrFail($request->id)->update([
                'slider_title' => $request->slider_title,
                'short_title' => $request->short_title,
            ]);

            $notification = array(
                'message' => 'Slider Updated without image Successfully',
                'alert-type' => 'success'
            );

        }
        return redirect()->route('all.slider')->with($notification); // end else

    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    final public function deleteSlider(int $id): RedirectResponse
    {
        $slider = Slider::findOrFail($id);
        if ($slider->slider_image) unlink($slider->slider_image);

        Slider::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Slider Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
