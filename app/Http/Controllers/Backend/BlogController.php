<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Intervention\Image\Facades\Image;

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


    public function allBlogPost(): Factory|View|Application
    {
        $blogpost = BlogPost::latest()->get();
        return view('backend.blog.post.blogpost_all', compact('blogpost'));
    }

    public function addBlogPost()
    {
        $blogCategory = BlogCategory::latest()->get();
        return view('backend.blog.post.blogpost_add', compact('blogCategory'));
    }

    public function storeBlogPost(Request $request): RedirectResponse
    {
        $image = $request->file('post_image');
        $generateName = hexdec(uniqid('', false)) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(1103, 906)->save('upload/blog/' . $generateName);
        $saveUrl = 'upload/blog/' . $generateName;

        BlogPost::insert([
            'category_id' => $request->category_id,
            'post_title' => $request->post_title,
            'post_slug' => strtolower(str_replace(' ', '-', $this->vnToStr($request->post_title))),
            'post_short_description' => $request->post_short_description,
            'post_long_description' => $request->post_long_description,
            'post_image' => $saveUrl,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Blog Post Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.blog.post')->with($notification);
    }


    public function editBlogPost($id): Factory|View|Application
    {
        $blogCategory = BlogCategory::latest()->get();
        $blogpost = BlogPost::findOrFail($id);
        return view('backend.blog.post.blogpost_edit', compact('blogCategory', 'blogpost'));
    }// End Method


    public function updateBlogPost(Request $request)
    {
        $postId = $request->id;
        $oldImg = $request->old_image;

        if ($request->file('post_image')) {

            $image = $request->file('post_image');
            $generateName = hexdec(uniqid('', false)) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(1103, 906)->save('upload/blog/' . $generateName);
            $saveUrl = 'upload/blog/' . $generateName;

            if (file_exists($oldImg)) {
                unlink($oldImg);
            }

            BlogPost::findOrFail($postId)->update([
                'category_id' => $request->category_id,
                'post_title' => $request->post_title,
                'post_slug' => strtolower(str_replace(' ', '-', $this->vnToStr($request->post_title))),
                'post_short_description' => $request->post_short_description,
                'post_long_description' => $request->post_long_description,
                'post_image' => $saveUrl,
                'updated_at' => Carbon::now(),
            ]);

            $notification = array(
                'message' => 'Blog Post Updated with image Successfully',
                'alert-type' => 'success'
            );
        } else {

            BlogPost::findOrFail($postId)->update([
                'category_id' => $request->category_id,
                'post_title' => $request->post_title,
                'post_slug' => strtolower(str_replace(' ', '-', $this->vnToStr($request->post_title))),
                'post_short_description' => $request->post_short_description,
                'post_long_description' => $request->post_long_description,
                'updated_at' => Carbon::now(),
            ]);

            $notification = array(
                'message' => 'Blog Post Updated without image Successfully',
                'alert-type' => 'success'
            );
        }
        return redirect()->route('admin.blog.post')->with($notification);
    }


    public function deleteBlogPost(int $id)
    {

        $blogpost = BlogPost::findOrFail($id);
        $img = $blogpost->post_image;
        if ($img) unlink($img);

        BlogPost::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Blog Post Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function allBlog(): Factory|View|Application
    {
        $blogCategories = BlogCategory::latest()->get();
        $blogpost = BlogPost::latest()->get();
        return view('frontend.blog.home_blog', compact('blogCategories', 'blogpost'));
    }

    public function blogDetails(int $id, string $slug): Factory|View|Application
    {
        $blogCategories = BlogCategory::latest()->get();
        $blogDetails = BlogPost::findOrFail($id);
        $breadCat = BlogCategory::where('id', $id)->get();
        return view('frontend.blog.blog_details', compact('blogCategories', 'blogDetails', 'breadCat'));
    }

    public function blogPostCategory(int $id, string $slug)
    {
        $blogCategories = BlogCategory::latest()->get();
        $blogPost = BlogPost::where('category_id', $id)->get();
        $breadCat = BlogCategory::where('id', $id)->get();
        return view('frontend.blog.category_post', compact('blogCategories', 'blogPost', 'breadCat'));
    }
}
