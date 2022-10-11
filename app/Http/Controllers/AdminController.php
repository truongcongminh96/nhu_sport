<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * @return Factory|View|Application
     */
    public function adminDashboard(): Factory|View|Application
    {
        return view('admin.index');
    }

    /**
     * @param Request $request
     * @return Redirector|Application|RedirectResponse
     */
    public function adminLogout(Request $request): Redirector|Application|RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }

    /**
     * @return Factory|View|Application
     */
    public function adminLogin(): Factory|View|Application
    {
        return view('admin.admin_login');
    }

    /**
     * @return Factory|View|Application
     */
    public function adminProfile(): Factory|View|Application
    {
        $adminProfile = User::find(Auth::id());
        return view('admin.admin_profile_view', compact('adminProfile'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function adminProfileStore(Request $request): RedirectResponse
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
        $notification = [
            'message' => 'Admin Profile Updated!',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }
}
