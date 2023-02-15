<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'brand_id',
        'category_id',
        'subcategory_id',
        'product_name',
        'product_slug',
        'product_code',
        'product_qty',
        'product_tags',
        'product_size',
        'product_color',
        'selling_price',
        'discount_price',
        'short_description',
        'long_description',
        'product_thumbnail',
        'vendor_id',
        'hot_deals',
        'featured',
        'special_offer',
        'special_deals',
        'status'
    ];

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'vendor_id', 'id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function subcategory(): BelongsTo
    {
        return $this->belongsTo(SubCategory::class, 'subcategory_id', 'id');
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }
}
