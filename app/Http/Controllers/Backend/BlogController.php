<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class BlogController extends Controller
{
    public function allBlogCategory(): Factory|View|Application
    {
        $blogCategories = BlogCategory::latest()->get();
        return view('backend.blog.category.blog_category_all', compact('blogCategories'));
    }

    public function addBlogCategory(): Factory|View|Application
    {
        return view('backend.blog.category.blog_category_add');
    }

    public function storeBlogCategory(Request $request): RedirectResponse
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

    public function editBlogCategory($id): Factory|View|Application
    {

        $blogCategories = BlogCategory::findOrFail($id);
        return view('backend.blog.category.blog_category_edit', compact('blogCategories'));

    }

    public function updateBlogCategory(Request $request): RedirectResponse
    {

        $blogId = $request->id;
        BlogCategory::findOrFail($blogId)->update([
            'blog_category_name' => $request->blog_category_name,
            'blog_category_slug' => strtolower(str_replace(' ', '-', $this->vnToStr($request->blog_category_name))),
        ]);

        $notification = array(
            'message' => 'Blog Category Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.blog.category')->with($notification);
    }


    public function deleteBlogCategory(int $id): RedirectResponse
    {
        BlogCategory::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Blog Category Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
