<?php

namespace App\Strategy\ConcreteStrategyVendor;

use App\Models\User;
use App\Strategy\BuildProfileStrategyInterface;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;

class ConcreteVendorProfile implements BuildProfileStrategyInterface
{
    /**
     * @param Request $request
     * @return void
     */
    public function updateProfile(Request $request): void
    {
        $vendorData = User::find(Auth::id());
        $vendorData->name = $request->name;
        $vendorData->email = $request->email;
        $vendorData->phone = $request->phone;
        $vendorData->address = $request->address;

        if ($request->file('photo')) {
            $file = $request->file('photo');
            if ($vendorData->photo) @unlink(public_path('upload/vendor_images/' . $vendorData->photo));
            $fileName = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/vendor_images'), $fileName);
            $vendorData->photo = $fileName;
        }

        $vendorData->save();
    }
}
