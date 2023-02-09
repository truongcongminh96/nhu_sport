<?php

namespace App\Http\Controllers;

use App\Context\BuildProfileContext;
use App\Models\User;
use App\Strategy\ConcreteStrategyAdmin\ConcreteAdminProfile;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    private BuildProfileContext $buildProfileContext;

    /**
     * @param BuildProfileContext $buildProfileContext
     */
    public function __construct(BuildProfileContext $buildProfileContext)
    {
        $this->buildProfileContext = $buildProfileContext;
        $this->buildProfileContext->setBuildProfileContext(new ConcreteAdminProfile());
    }

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
        $this->buildProfileContext->runUpdateProfile($request);
        $notification = [
            'message' => 'Admin Profile Updated!',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }

    /**
     * @return Factory|View|Application
     */
    public function adminChangePassword(): Factory|View|Application
    {
        return view('admin.admin_change_password');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function adminUpdatePassword(Request $request): RedirectResponse
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

    public function inactiveVendor(): Factory|View|Application
    {
        $inactiveVendor = User::where(['status' => User::STATUS_INACTIVE, 'role' => User::ROLE_VENDOR])->latest()->get();
        return view('backend.vendor.inactive_vendor', compact('inactiveVendor'));
    }

    public function activeVendor(): Factory|View|Application
    {
        $activeVendor = User::where(['status' => User::STATUS_ACTIVE, 'role' => User::ROLE_VENDOR])->latest()->get();
        return view('backend.vendor.active_vendor', compact('activeVendor'));
    }

    public function inactiveVendorDetails($id): Factory|View|Application
    {
        $inactiveVendorDetails = User::findOrFail($id);
        return view('backend.vendor.inactive_vendor_details', compact('inactiveVendorDetails'));
    }

    public function activeVendorApprove(Request $request): RedirectResponse
    {
        User::findOrFail($request->id)->update([
            'status' => User::STATUS_ACTIVE
        ]);

        $notification = [
            'message' => 'Vendor Activated Update Successfully!',
            'alert-type' => 'success'
        ];

        return redirect()->route('active.vendor')->with($notification);
    }

    public function activeVendorDetails($id): Factory|View|Application
    {
        $activeVendorDetails = User::findOrFail($id);
        return view('backend.vendor.active_vendor_details', compact('activeVendorDetails'));
    }

    public function inactiveVendorApprove(Request $request): RedirectResponse
    {
        User::findOrFail($request->id)->update([
            'status' => User::STATUS_INACTIVE
        ]);

        $notification = [
            'message' => 'Vendor Activated Update Successfully!',
            'alert-type' => 'success'
        ];

        return redirect()->route('active.vendor')->with($notification);
    }
}
