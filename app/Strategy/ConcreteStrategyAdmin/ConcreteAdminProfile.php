<?php

namespace App\Strategy\ConcreteStrategyAdmin;

use App\Models\User;
use App\Strategy\BuildProfileStrategyInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConcreteAdminProfile implements BuildProfileStrategyInterface
{
    /**
     * @param Request $request
     * @return void
     */
    public function updateProfile(Request $request): void
    {
        $adminData = User::find(Auth::id());
        $adminData->name = $request->name;
        $adminData->email = $request->email;
        $adminData->phone = $request->phone;
        $adminData->address = $request->address;

        if ($request->file('photo')) {
            $file = $request->file('photo');
            if ($adminData->photo) @unlink(public_path('upload/admin_images/' . $adminData->photo));
            $fileName = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'), $fileName);
            $adminData->photo = $fileName;
        }

        $adminData->save();
    }
}
