<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function vendorDashboard(): Factory|View|Application
    {
        return view('vendor.vendor_dashboard');
    }
}
