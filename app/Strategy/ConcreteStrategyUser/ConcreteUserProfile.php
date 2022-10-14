<?php

namespace App\Strategy\ConcreteStrategyUser;

use App\Models\User;
use App\Strategy\BuildProfileStrategyInterface;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;

class ConcreteUserProfile implements BuildProfileStrategyInterface
{
    /**
     * @param Request $request
     * @return void
     */
    public function updateProfile(Request $request): void
    {
        $userData = User::find(Auth::id());
        $userData->name = $request->name;
        $userData->username = $request->username;
        $userData->email = $request->email;
        $userData->phone = $request->phone;
        $userData->address = $request->address;

        if ($request->file('photo')) {
            $file = $request->file('photo');
            if ($userData->photo) @unlink(public_path('upload/user_images/' . $userData->photo));
            $fileName = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/user_images'), $fileName);
            $userData->photo = $fileName;
        }

        $userData->save();
    }
}
