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
    public function adminDashboard(): Factory|View|Application
    {
        return view('admin.index');
    }

    public function adminLogout(Request $request): Redirector|Application|RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }

    public function adminLogin(): Factory|View|Application
    {
        return view('admin.admin_login');
    }

    public function adminProfile(): Factory|View|Application
    {
        $adminProfile = User::find(Auth::id());
        return view('admin.admin_profile_view', compact('adminProfile'));
    }
}
