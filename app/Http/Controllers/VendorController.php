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
use Illuminate\Support\Facades\Hash;

class VendorController extends Controller
{
    /**
     * @return Factory|View|Application
     */
    public function vendorDashboard(): Factory|View|Application
    {
        return view('vendor.index');
    }

    /**
     * @param Request $request
     * @return Redirector|Application|RedirectResponse
     */
    public function vendorLogout(Request $request): Redirector|Application|RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/vendor/login');
    }

    /**
     * @return Factory|View|Application
     */
    public function vendorLogin(): Factory|View|Application
    {
        return view('vendor.vendor_login');
    }

    /**
     * @return Factory|View|Application
     */
    public function vendorProfile(): Factory|View|Application
    {
        $vendorProfile = User::find(Auth::id());
        return view('vendor.vendor_profile_view', compact('vendorProfile'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function vendorProfileStore(Request $request): RedirectResponse
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
        $notification = [
            'message' => 'Vendor Profile Updated!',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }

    /**
     * @return Factory|View|Application
     */
    public function vendorChangePassword(): Factory|View|Application
    {
        return view('vendor.vendor_change_password');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function vendorUpdatePassword(Request $request): RedirectResponse
    {
        $request->validate([
            'old_password' => 'required|min:8',
            'new_password' => 'required|min:8|required_with:confirm_new_password|same:confirm_new_password',
            'confirm_new_password' => 'required|min:8'
        ]);

        if (!Hash::check($request->old_password, Auth::user()->getAuthPassword())) return back()->with('error', 'old password does not match');

        User::whereId(Auth::id())->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with('status', 'Your password has been changed');
    }
}
