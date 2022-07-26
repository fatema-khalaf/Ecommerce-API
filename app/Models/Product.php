<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable =[
        'brand_id',
        'category_id',
        'subcategory_id',
        'subsubcategory_id',
        'product_name_en',
        'product_name_ar',
        'product_slug_en',
        'product_slug_ar',
        'product_code',
        'product_qty',
        'product_tags_en',
        'product_tags_ar',
        'product_size_en',
        'product_size_ar',
        'product_color_en',
        'product_color_ar',
        'selling_price',
        'discount',
        'short_descp_en',
        'short_descp_ar',
        'long_descp_en',
        'long_descp_ar',
        'product_thambnail',
        'hot_deals',
        'featured',
        'special_offer',
        'special_deals',
        'status'
    ];
    public function images()
    {
        return $this->hasMany(Product_image::class, 'product_id');
    }
    // public function brands()
    // {
    //     return $this->belo(Product_image::class, 'product_id');
    // }
    /**
     * Get the brands that owns the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function brands()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

}
