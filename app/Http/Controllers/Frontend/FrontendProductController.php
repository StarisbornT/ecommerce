<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Products;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FrontendProductController extends Controller
{
    public function showProduct(string $slug) {
        $product = Products::with(['vendor', 'category', 'productImageGallery', 'variants', 'brand'])->where('slug', $slug)->where('status', 1)->first();
        return view('frontend.pages.product-detail', compact('product'));
    }
}