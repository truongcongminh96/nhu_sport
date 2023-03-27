<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\BannerController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\VendorProductController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendorController;
use App\Http\Middleware\RedirectIfAuthenticated;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [IndexController::class, 'index']);

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'userDashboard'])->name('dashboard');
    Route::post('/user/profile/store', [UserController::class, 'userProfileStore'])->name('user.profile.store');
    Route::get('/user/profile/logout', [UserController::class, 'userLogout'])->name('user.logout');
    Route::post('/user/update/password', [UserController::class, 'userUpdatePassword'])->name('user.update.password');
});

//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__ . '/auth.php';

//Admin Dashboard
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('/admin/logout', [AdminController::class, 'adminLogout'])->name('admin.logout');
    Route::get('/admin/profile', [AdminController::class, 'adminProfile'])->name('admin.profile');
    Route::post('/admin/profile/store', [AdminController::class, 'adminProfileStore'])->name('admin.profile.store');
    Route::get('/admin/profile/change-password', [AdminController::class, 'adminChangePassword'])->name('admin.change.password');
    Route::post('/admin/update-password', [AdminController::class, 'adminUpdatePassword'])->name('update.password');
});

//Vendor Dashboard
Route::middleware(['auth', 'role:vendor'])->group(function () {
    Route::get('/vendor/dashboard', [VendorController::class, 'vendorDashboard'])->name('vendor.dashboard');
    Route::get('/vendor/logout', [VendorController::class, 'vendorLogout'])->name('vendor.logout');
    Route::get('/vendor/profile', [VendorController::class, 'vendorProfile'])->name('vendor.profile');
    Route::post('/vendor/profile/store', [VendorController::class, 'vendorProfileStore'])->name('vendor.profile.store');
    Route::get('/vendor/profile/change-password', [VendorController::class, 'vendorChangePassword'])->name('vendor.change.password');
    Route::post('/vendor/update-password', [VendorController::class, 'vendorUpdatePassword'])->name('vendor.update.password');
});

Route::get('/admin/login', [AdminController::class, 'adminLogin'])->middleware(RedirectIfAuthenticated::class);
Route::get('/vendor/login', [VendorController::class, 'vendorLogin'])->name('vendor.login')->middleware(RedirectIfAuthenticated::class);
Route::get('/become/vendor', [VendorController::class, 'becomeVendor'])->name('become.vendor');
Route::post('/vendor/register', [VendorController::class, 'vendorRegister'])->name('vendor.register');

Route::middleware(['auth', 'role:admin'])->group(function () {
    //Admin Brand
    Route::controller(BrandController::class)->group(function () {
        Route::get('/all/brand', 'allBrand')->name('all.brand');
        Route::get('/add/brand', 'addBrand')->name('add.brand');
        Route::post('/store/brand', 'storeBrand')->name('store.brand');
        Route::get('/edit/brand/{id}', 'editBrand')->name('edit.brand');
        Route::post('/update/brand', 'updateBrand')->name('update.brand');
        Route::get('/delete/brand/{id}', 'deleteBrand')->name('delete.brand');
    });

    //Admin Category
    Route::controller(CategoryController::class)->group(function () {
        Route::get('/all/category', 'allCategory')->name('all.category');
        Route::get('/add/category', 'addCategory')->name('add.category');
        Route::post('/store/category', 'storeCategory')->name('store.category');
        Route::get('/edit/category/{id}', 'editCategory')->name('edit.category');
        Route::post('/update/category', 'updateCategory')->name('update.category');
        Route::get('/delete/category/{id}', 'deleteCategory')->name('delete.category');
    });

    //Admin Category
    Route::controller(SubCategoryController::class)->group(function () {
        Route::get('/all/subcategory', 'allSubCategory')->name('all.subcategory');
        Route::get('/add/subcategory', 'addSubCategory')->name('add.subcategory');
        Route::post('/store/subcategory', 'storeSubCategory')->name('store.subcategory');
        Route::get('/edit/subcategory/{id}', 'editSubCategory')->name('edit.subcategory');
        Route::post('/update/subcategory', 'updateSubCategory')->name('update.subcategory');
        Route::get('/delete/subcategory/{id}', 'deleteSubCategory')->name('delete.subcategory');
        Route::get('/subcategory/ajax/{categoryId}', 'getSubCategory');
    });

    //Admin Manage Vendor
    Route::controller(AdminController::class)->group(function () {
        Route::get('/inactive/vendor', 'inactiveVendor')->name('inactive.vendor');
        Route::get('/active/vendor', 'activeVendor')->name('active.vendor');
        Route::get('/inactive/vendor/details/{id}', 'inactiveVendorDetails')->name('inactive.vendor.details');
        Route::post('/active/vendor/approve', 'activeVendorApprove')->name('active.vendor.approve');
        Route::get('/active/vendor/details/{id}', 'activeVendorDetails')->name('active.vendor.details');
        Route::post('/inactive/vendor/approve', 'inactiveVendorApprove')->name('inactive.vendor.approve');
    });

    Route::controller(VendorProductController::class)->group(function () {
        Route::get('/vendor/all/product', 'vendorAllProduct')->name('vendor.all.product');
    });

    //Admin Manage Product
    Route::controller(ProductController::class)->group(function () {
        Route::get('/all/product', 'allProduct')->name('all.product');
        Route::get('/add/product', 'addProduct')->name('add.product');
        Route::post('/store/product', 'storeProduct')->name('store.product');
        Route::get('/edit/product/{id}', 'editProduct')->name('edit.product');
        Route::post('/update/product', 'updateProduct')->name('update.product');
        Route::post('/update/product/thumbnail', 'updateProductThumbnail')->name('update.product.thumbnail');
        Route::post('/update/product/multiple_images', 'updateProductMultipleImages')->name('update.product.multiple_images');
        Route::get('/delete/product/multiple_images/{id}', 'deleteProductMultipleImages')->name('product.multiple.images.delete');
        Route::get('/product/inactive/{id}', 'productInactive')->name('product.inactive');
        Route::get('/product/active/{id}', 'productActive')->name('product.active');
        Route::get('/delete/product/{id}', 'productDelete')->name('delete.product');
    });

    //Admin Slider
    Route::controller(SliderController::class)->group(function () {
        Route::get('/all/slider', 'allSlider')->name('all.slider');
        Route::get('/add/slider', 'addSlider')->name('add.slider');
        Route::post('/store/slider', 'storeSlider')->name('store.slider');
        Route::get('/edit/slider/{id}', 'EditSlider')->name('edit.slider');
        Route::post('/update/slider', 'UpdateSlider')->name('update.slider');
        Route::get('/delete/slider/{id}', 'DeleteSlider')->name('delete.slider');
    });

    //Admin Slider
    Route::controller(BannerController::class)->group(function () {
        Route::get('/all/banner', 'allBanner')->name('all.banner');
        Route::get('/add/banner', 'addBanner')->name('add.banner');
        Route::post('/store/banner', 'storeBanner')->name('store.banner');
        Route::get('/edit/banner/{id}', 'editBanner')->name('edit.banner');
        Route::post('/update/banner', 'updateBanner')->name('update.banner');
        Route::get('/delete/banner/{id}', 'DeleteBanner')->name('delete.banner');
    });
});

/// Frontend Product Details All Route
Route::get('/product/details/{id}/{slug}', [IndexController::class, 'ProductDetails']);
Route::get('/brand/details/{id}', [IndexController::class, 'brandDetails'])->name('brand.details');
Route::get('/list/brand/all', [IndexController::class, 'listBrandAll'])->name('list.brand.all');
Route::get('/product/category/{id}/{slug}', [IndexController::class, 'catWiseProduct']);
Route::get('/product/subcategory/{id}/{slug}', [IndexController::class, 'subCatWiseProduct']);
Route::get('/product/view/modal/{id}', [IndexController::class, 'productViewAjax']);

//Add to cart store data
Route::post('/cart/data/store/{id}', [CartController::class, 'addToCart']);
Route::get('/product/mini/cart', [CartController::class, 'addMiniCart']);
