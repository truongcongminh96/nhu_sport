<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class BlogController extends Controller
{
    public function allBlogCategory()
    {
        $blogCategories = BlogCategory::latest()->get();
        return view('backend.blog.category.blog_category_all', compact('blogCategories'));
    }

    public function addBlogCategory()
    {
        return view('backend.blog.category.blog_category_add');
    }

    public function storeBlogCategory(Request $request)
    {
        BlogCategory::insert([
            'blog_category_name' => $request->blog_category_name,
            'blog_category_slug' => strtolower(str_replace(' ', '-', $this->vnToStr($request->blog_category_name))),
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Blog Category Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.blog.category')->with($notification);

    }
}
