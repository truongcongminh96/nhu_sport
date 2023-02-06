<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function allSubCategory(): Factory|View|Application
    {
        $subCategories = SubCategory::latest()->get();
        return view('backend.subcategory.subcategory_all', compact('subCategories'));
    }

    public function addSubCategory(): Factory|View|Application
    {
        $categories = Category::latest()->get();
        return view('backend.subcategory.subcategory_add', compact('categories'));
    }
}
