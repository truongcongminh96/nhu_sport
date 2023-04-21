<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class SiteSettingController extends Controller
{
    public function siteSetting()
    {
        $setting = SiteSetting::find(1);
        return view('backend.setting.setting_update', compact('setting'));
    }

    public function siteSettingUpdate(Request $request)
    {
        $settingId = $request->id;

        if ($request->file('logo')) {
            $image = $request->file('logo');
            $nameGen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(180, 56)->save('upload/logo/' . $nameGen);
            $saveUrl = 'upload/logo/' . $nameGen;

            SiteSetting::findOrFail($settingId)->update([
                'support_phone' => $request->support_phone,
                'phone_one' => $request->phone_one,
                'email' => $request->email,
                'company_address' => $request->company_address,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'youtube' => $request->youtube,
                'copyright' => $request->copyright,
                'logo' => $saveUrl,
            ]);

            $notification = array(
                'message' => 'Site Setting Updated with image Successfully',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);

        } else {
            SiteSetting::findOrFail($settingId)->update([
                'support_phone' => $request->support_phone,
                'phone_one' => $request->phone_one,
                'email' => $request->email,
                'company_address' => $request->company_address,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'youtube' => $request->youtube,
                'copyright' => $request->copyright,
            ]);

            $notification = array(
                'message' => 'Site Setting Updated without image Successfully',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
        }
    }
}
