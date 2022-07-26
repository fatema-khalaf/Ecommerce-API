<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_id');
            $table->foreign('brand_id')->references('id')->on('brands');//->onDelete('cascade');
            $table->foreignId('category_id');
            $table->foreign('category_id')->references('id')->on('categories');//->onDelete('cascade');
            $table->foreignId('subcategory_id');
            $table->foreign('subcategory_id')->references('id')->on('subcategories');//->onDelete('cascade');
            $table->foreignId('subsubcategory_id');
            $table->foreign('subsubcategory_id')->references('id')->on('subsubcategories');//->onDelete('cascade');
            $table->string('product_name_en');
            $table->string('product_name_ar');
            $table->string('product_slug_en');
            $table->string('product_slug_ar');
            $table->string('product_code');
            $table->string('product_qty');
            $table->string('product_tags_en')->nullable();
            $table->string('product_tags_ar')->nullable();
            $table->string('product_size_en')->nullable();
            $table->string('product_size_ar')->nullable();
            $table->string('product_color_en')->nullable();
            $table->string('product_color_ar')->nullable();
            $table->integer('selling_price');
            $table->string('discount')->nullable();
            $table->string('short_descp_en')->default('description');
            $table->string('short_descp_ar')->default('الوصف');
            $table->string('long_descp_en')->default('description');
            $table->string('long_descp_ar')->default('الوصف');
            $table->string('product_thambnail');
            $table->integer('hot_deals')->nullable();
            $table->integer('featured')->nullable();
            $table->integer('special_offer')->nullable();
            $table->integer('special_deals')->nullable();
            $table->integer('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
