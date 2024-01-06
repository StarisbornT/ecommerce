<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    public function vendor() {
        return $this->belongsTo(Vendor::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function productImageGallery() {
        return $this->hasMany(ProductImageGallery::class);
    }

    public function variants() {
        return $this->hasMany(ProductVariant::class);
    }

    public function brand() {
        return $this->belongsTo(Brand::class);
    }
}