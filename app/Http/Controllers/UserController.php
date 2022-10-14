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

        return redirect('/login');
    }
}
