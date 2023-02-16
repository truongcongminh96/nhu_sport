<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\MultipleImage;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    /**
     * @return Factory|View|Application
     */
    final public function allProduct(): Factory|View|Application
    {
        $products = Product::latest()->get();
        return view('backend.product.product_all', compact('products'));
    }

    /**
     * @return Factory|View|Application
     */
    final public function addProduct(): Factory|View|Application
    {
        $activeVendor = User::where(['status' => User::STATUS_ACTIVE, 'role' => User::ROLE_VENDOR])->latest()->get();
        $brands = Brand::latest()->get();
        $categories = Category::latest()->get();
        return view('backend.product.product_add', compact('brands', 'categories', 'activeVendor'));
    }

    final public function storeProduct(Request $request): RedirectResponse
    {
        $image = $request->file('product_thumbnail');
        $nameGenerate = hexdec(uniqid('', false)) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(800, 800)->save('upload/products/thumbnail/' . $nameGenerate);
        $saveUrl = 'upload/products/thumbnail/' . $nameGenerate;

        $productId = Product::insertGetId([
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'product_name' => $request->product_name,
            'product_slug' => strtolower(str_replace(' ', '-', $this->vnToStr($request->product_name))),

            'product_code' => $request->product_code,
            'product_qty' => $request->product_qty,
            'product_tags' => $request->product_tags,
            'product_size' => $request->product_size,
            'product_color' => $request->product_color,

            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,

            'hot_deals' => $request->hot_deals,
            'featured' => $request->featured,
            'special_offer' => $request->special_offer,
            'special_deals' => $request->special_deals,

            'product_thumbnail' => $saveUrl,
            'vendor_id' => $request->vendor_id,
            'status' => 1,
            'created_at' => Carbon::now(),
        ]);

        $images = $request->file('multi_img');
        foreach ($images as $img) {
            $makeName = hexdec(uniqid('', false)) . '.' . $img->getClientOriginalExtension();
            Image::make($img)->resize(800, 800)->save('upload/products/multiple-image/' . $makeName);
            $uploadPath = 'upload/products/multiple-image/' . $makeName;
            MultipleImage::insert([
                'product_id' => $productId,
                'photo_name' => $uploadPath,
                'created_at' => Carbon::now(),
            ]);
        }

        $notification = array(
            'message' => 'Product Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.product')->with($notification);
    }

    /**
     * @param int $id
     * @return Factory|View|Application
     */
    final public function editProduct(int $id): Factory|View|Application
    {
        $activeVendor = User::where(['status' => 'active', 'role' => 'vendor'])->latest()->get();
        $brands = Brand::latest()->get();
        $categories = Category::latest()->get();
        $subcategory = SubCategory::latest()->get();
        $products = Product::findOrFail($id);
        $multipleImages = MultipleImage::where(['product_id' => $id])->get();
        return view('backend.product.product_edit', compact('brands', 'categories', 'activeVendor', 'products', 'subcategory', 'multipleImages'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    final public function UpdateProduct(Request $request): RedirectResponse
    {
        Product::findOrFail($request->id)->update([

            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'product_name' => $request->product_name,
            'product_slug' => strtolower(str_replace(' ', '-', $request->product_name)),

            'product_code' => $request->product_code,
            'product_qty' => $request->product_qty,
            'product_tags' => $request->product_tags,
            'product_size' => $request->product_size,
            'product_color' => $request->product_color,

            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'short_descp' => $request->short_descp,
            'long_descp' => $request->long_descp,

            'hot_deals' => $request->hot_deals,
            'featured' => $request->featured,
            'special_offer' => $request->special_offer,
            'special_deals' => $request->special_deals,

            'vendor_id' => $request->vendor_id,
            'status' => 1,
            'created_at' => Carbon::now(),

        ]);

        $notification = array(
            'message' => 'Product Updated Without Image Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.product')->with($notification);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    final public function updateProductThumbnail(Request $request): RedirectResponse
    {
        $image = $request->file('product_thumbnail');
        $nameGenerate = hexdec(uniqid('', false)) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(800, 800)->save('upload/products/thumbnail/' . $nameGenerate);
        $saveUrl = 'upload/products/thumbnail/' . $nameGenerate;

        if (file_exists($request->old_image)) unlink($request->old_image);

        Product::findOrFail($request->id)->update([
            'product_thumbnail' => $saveUrl,
            'update_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Product Updated Thumbnail Image Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    final public function updateProductMultipleImages(Request $request): RedirectResponse
    {
        if (empty($request->multiple_images)) {
            return redirect()->back();
        }

        foreach ($request->multiple_images as $id => $image) {
            $imageDelete = MultipleImage::findOrFail($id);
            if ($imageDelete) unlink($imageDelete->photo_name);

            $makeName = hexdec(uniqid('', false)) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(800, 800)->save('upload/products/multiple-image/' . $makeName);
            $uploadPath = 'upload/products/multiple-image/' . $makeName;

            MultipleImage::where('id', $id)->update([
                'photo_name' => $uploadPath,
                'updated_at' => Carbon::now(),
            ]);
        }

        $notification = array(
            'message' => 'Product Multi Image Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    final public function deleteProductMultipleImages(int $id): RedirectResponse
    {
        $oldImage = MultipleImage::findOrFail($id);
        if ($oldImage) unlink($oldImage->photo_name);

        MultipleImage::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Product Multi Image Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    final public function productInactive(int $id): RedirectResponse
    {
        Product::findOrFail($id)->update(['status' => 0]);
        $notification = array(
            'message' => 'Product Inactive',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    final public function productActive(int $id): RedirectResponse
    {
        Product::findOrFail($id)->update(['status' => 1]);
        $notification = array(
            'message' => 'Product Active',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }


    /**
     * @param int $id
     * @return RedirectResponse
     */
    final public function productDelete(int $id): RedirectResponse
    {
        $product = Product::findOrFail($id);
        unlink($product->product_thumbnail);
        Product::findOrFail($id)->delete();

        $images = MultipleImage::where(['product_id' => $id])->get();
        foreach ($images as $img) {
            unlink($img->photo_name);
            MultipleImage::where(['product_id' => $id])->delete();
        }

        $notification = array(
            'message' => 'Product Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
