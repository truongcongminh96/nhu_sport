<?php

namespace App\Http\Controllers;

use App\Context\BuildProfileContext;
use App\Models\User;
use App\Strategy\ConcreteStrategyUser\ConcreteUserProfile;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private BuildProfileContext $buildProfileContext;

    /**
     * @param BuildProfileContext $buildProfileContext
     */
    public function __construct(BuildProfileContext $buildProfileContext)
    {
        $this->buildProfileContext = $buildProfileContext;
        $this->buildProfileContext->setBuildProfileContext(new ConcreteUserProfile());
    }

    /**
     * @return Factory|View|Application
     */
    public function userDashboard(): Factory|View|Application
    {
        $userData = User::find(Auth::id());
        return view('index', compact('userData'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function userProfileStore(Request $request): RedirectResponse
    {
        $this->buildProfileContext->runUpdateProfile($request);
        $notification = [
            'message' => 'User Profile Updated!',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }

    /**
     * @param Request $request
     * @return Redirector|Application|RedirectResponse
     */
    public function userLogout(Request $request): Redirector|Application|RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = [
            'message' => 'Bạn đã đăng xuất khỏi ứng dụng',
            'alert-type' => 'success'
        ];

        return redirect('/login')->with($notification);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function userUpdatePassword(Request $request): RedirectResponse
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
