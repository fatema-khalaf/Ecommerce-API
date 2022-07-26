<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subsubcategory extends Model
{
    use HasFactory;
    protected $fillable = ['subcategory_id', 'subsubcategory_name_en','subsubcategory_name_ar','subsubcategory_slug_en','subsubcategory_slug_ar'];

    // public function category()
    // {
    //     return $this->belongsToThrough(Category::class, Subcategory::class);
    //     // return $this->belongsTo(Category::class, 'category_id');
    // }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class, 'subcategory_id');
    }
}
