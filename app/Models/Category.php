<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['category_name_en','category_name_ar','category_slug_en','category_slug_ar','category_icon'];
    
    public function subcategories()
    {
        return $this->hasMany(Subcategory::class, 'category_id');
    }

    public function subsubcategories()
    {
        return $this->hasManyThrough( Subsubcategory::class, Subcategory::class);
    }
}
