<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Slider;
use App\Models\SubCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class InitDataBaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $this->createBrands();
        $this->createCategoryAndSubcategory();
        $this->createSlider();
    }

    private function createBrands()
    {
        Brand::create(
            [
                'brand_name' => 'Yonex',
                'brand_slug' => 'yonex',
                'brand_image' => 'upload/brand/yonex.jpg',
                'brand_since' => '1946',
                'brand_address' => 'Tôkyô, Nhật Bản',
                'short_info' => 'Công ty TNHH Yonex là một công ty sản xuất dụng cụ thể thao của Nhật Bản. Yonex sản xuất thiết bị và quần áo cho quần vợt, cầu lông, gôn và chạy. Các sản phẩm được sản xuất và thương mại hóa bao gồm thiết bị cho cầu lông, quần vợt và chơi gôn.'
            ]
        );

        Brand::create(
            [
                'brand_name' => 'Lining',
                'brand_slug' => 'lining',
                'brand_image' => 'upload/brand/lining.jpg',
                'brand_since' => '1989',
                'brand_address' => 'Bắc Kinh, Trung Quốc',
                'short_info' => 'Công ty Trách nhiệm hữu hạn Li Ning là công ty sản xuất dụng cụ và trang phục thể thao lớn của Trung Quốc. Các sản phẩm mang nhãn hiệu Li-Ning hướng tới đối tượng khách hàng là những người chơi các môn thể thao như chạy bộ, bóng rổ, bóng đá, cầu lông và quần vợt.'
            ]
        );

        Brand::create(
            [
                'brand_name' => 'Victor',
                'brand_slug' => 'victor',
                'brand_image' => 'upload/brand/victor.jpg',
                'brand_since' => '1968',
                'brand_address' => 'Đài Loan',
                'short_info' => 'Victor Rackets Industrial Corporation là một nhà sản xuất dụng cụ thể thao của Đài Loan với các sản phẩm từ vợt cầu lông và bóng quần, quần áo thể thao, giày, tất và các thiết bị khác cho thể thao. Sản phẩm của nó là một trong những sản phẩm được Liên đoàn Cầu lông Thế giới phê duyệt cho các giải đấu quốc tế.'
            ]
        );

        Brand::create(
            [
                'brand_name' => 'Mizuno',
                'brand_slug' => 'mizuno',
                'brand_image' => 'upload/brand/mizuno.jpg',
                'brand_since' => '1906',
                'brand_address' => 'Chiyoda, Tôkyô, Nhật Bản',
                'short_info' => 'Mizuno là một công ty về dụng cụ và đồ thể thao, thành lập ở Osaka vào năm 1906 bởi Rihachi Mizuno.'
            ]
        );
    }

    private function createCategoryAndSubcategory()
    {
        $category1 = Category::create([
            'category_name' => 'VỢT CẦU LÔNG',
            'category_slug' => 'vot-cau-long',
            'category_image' => 'upload/category/vot-cau-long.jpg'
        ]);
        SubCategory::create([
            'category_id' => $category1->id,
            'subcategory_name' => 'Vợt cầu lông Yonex',
            'subcategory_slug' => 'vot-cau-long-yonex'
        ]);

        SubCategory::create([
            'category_id' => $category1->id,
            'subcategory_name' => 'Vợt cầu lông Lining',
            'subcategory_slug' => 'vot-cau-long-lining'
        ]);

        $category2 = Category::create([
            'category_name' => 'GIÀY CẦU LÔNG',
            'category_slug' => 'giay-cau-long',
            'category_image' => 'upload/category/giay-cau-long.jpg'
        ]);
        SubCategory::create([
            'category_id' => $category2->id,
            'subcategory_name' => 'Giày cầu lông Yonex',
            'subcategory_slug' => 'giay-cau-long-yonex'
        ]);

        SubCategory::create([
            'category_id' => $category2->id,
            'subcategory_name' => 'Giày cầu lông Lining',
            'subcategory_slug' => 'giay-cau-long-lining'
        ]);

        $category3 = Category::create([
            'category_name' => 'ÁO CẦU LÔNG',
            'category_slug' => 'ao-cau-long',
            'category_image' => 'upload/category/ao-cau-long.jpg'
        ]);

        SubCategory::create([
            'category_id' => $category3->id,
            'subcategory_name' => 'Áo cầu lông Yonex',
            'subcategory_slug' => 'ao-cau-long-yonex'
        ]);

        SubCategory::create([
            'category_id' => $category3->id,
            'subcategory_name' => 'Áo cầu lông Lining',
            'subcategory_slug' => 'ao-cau-long-lining'
        ]);

        Category::create([
            'category_name' => 'VÁY CẦU LÔNG',
            'category_slug' => 'vay-cau-long',
            'category_image' => 'upload/category/vay-cau-long.jpg'
        ]);

        Category::create([
            'category_name' => 'QUẦN CẦU LÔNG',
            'category_slug' => 'quan-cau-long',
            'category_image' => 'upload/category/quan-cau-long.jpg'
        ]);

        Category::create([
            'category_name' => 'TÚI VỢT CẦU LÔNG',
            'category_slug' => 'tui-vot-cau-long',
            'category_image' => 'upload/category/tui-vot-cau-long.jpg'
        ]);

        Category::create([
            'category_name' => 'BALO CẦU LÔNG',
            'category_slug' => 'balo-cau-long',
            'category_image' => 'upload/category/balo-cau-long.jpg'
        ]);

        Category::create([
            'category_name' => 'Phụ kiện cầu lông',
            'category_slug' => 'phu-kien-cau-long',
            'category_image' => 'upload/category/phu-kien-cau-long.jpg'
        ]);
    }

    private function createSlider()
    {
        Slider::create(
            [
                'slider_title' => '',
                'short_title' => '',
                'slider_image' => 'upload/slider/slider1.jpg'
            ]
        );

        Slider::create(
            [
                'slider_title' => '',
                'short_title' => '',
                'slider_image' => 'upload/slider/slider2.jpg'
            ]
        );

        Slider::create(
            [
                'slider_title' => '',
                'short_title' => '',
                'slider_image' => 'upload/slider/slider3.jpg'
            ]
        );
    }
}
