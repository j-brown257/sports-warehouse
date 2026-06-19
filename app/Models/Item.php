<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\File;

class Item extends Model
{
    protected $table = 'item';
    protected $primaryKey = 'itemId';
    public $timestamps = false;

    public function category()
    {
        return $this->belongsTo(Category::class, 'categoryId', 'categoryId');
    }

    public function getSlugAttribute()
    {
        return Str::slug($this->itemName);
    }

    protected $fillable = ['itemName', 'photo', 'price', 'salePrice', 'description', 'featured', 'categoryId'];

    protected $casts = [
    'price'      => 'decimal:2',
    'salePrice'  => 'decimal:2',
    'featured'   => 'boolean',
    'categoryId' => 'integer',
];

protected function photoUrl(): Attribute
{
    return Attribute::get(function () {
        if ($this->photo && File::exists(public_path('assets/' . $this->photo))) {
            return asset('assets/' . $this->photo);
        }
        return asset('assets/placeholder-image.png');
    });
}

}