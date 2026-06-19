<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    protected $table = 'category';
    protected $primaryKey = 'categoryId';
    public $timestamps = false;

    public function items()
    {
        return $this->hasMany(Item::class, 'categoryId', 'categoryId');
    }

    /**
     * URL-safe slug version of the category name.
     * Eg. "Training Gear" → "training-gear", "Shoes" → "shoes"
     * Used as $category->slug in Blade or controllers.
     */
    public function getSlugAttribute()
    {
        return Str::slug($this->categoryName);
    }

    protected $fillable = ['categoryName'];
}