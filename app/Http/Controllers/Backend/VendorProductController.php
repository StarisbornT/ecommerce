<?php

namespace App\Http\Controllers\Backend;

use Str;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Products;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use App\Models\ChildCategory;
use App\Models\ProductVariant;
use App\Trait\ImageUploadTrait;
use App\Models\ProductImageGallery;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\DataTables\VendorProductDataTable;

class VendorProductController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(VendorProductDataTable $dataTable)
    {
        return $dataTable->render('vendor.product.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('vendor.product.create', compact('categories', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => ['required', 'image', 'max:3000'],
            'name' => ['required', 'max:200'],
            'category' => ['required'],
            // 'brand' => ['required'],
            'price' => ['required'],
            'qty' => ['required'],
            'short_description' => ['required', 'max:600'],
            'long_description' => ['required'],
            'seo_title' => ['max:200', 'nullable'],
            'seo_description' => ['max:250', 'nullable'],
            'status' => ['required']
        ]);

        $imagePath = $this->uploadImage($request, 'image', 'uploads');
        $products = new Products();
        $products->thumb_image = $imagePath;
        $products->name = $request->name;
        $products->slug = Str::slug($request->name);
        $products->vendor_id =Auth::user()->vendor->id;
        $products->category_id = $request->category;
        $products->sub_category_id = $request->sub_category;
        $products->child_category_id = $request->child_category;
        $products->brand_id = $request->brand;
        $products->qty = $request->qty;
        $products->short_description = $request->short_description;
        $products->long_description = $request->long_description;
        $products->video_link = $request->video_link;
        $products->sku = $request->sku;
        $products->price = $request->price;
        $products->offer_price = $request->offer_price;
        $products->offer_start_date = $request->offer_start_date;
        $products->offer_end_date = $request->offer_end_date;
        $products->product_type = $request->product_type;
        $products->status = $request->status;
        $products->is_approved = 0;
        $products->seo_title = $request->seo_title;
        $products->seo_description = $request->seo_description;
        $products->save();

        toastr('Created Successfully', 'success');
        return redirect()->route('vendor.products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $products = Products::findorFail($id);
        if ($products->vendor_id != Auth::user()->vendor->id) {
            abort(404);
        }
        $categories = Category::all();
        $subCategories = SubCategory::where('category_id', $products->category_id)->get();
        $childCategories = ChildCategory::where('sub_category_id', $products->sub_category_id)->get();
        $brands = Brand::all();
        return view('vendor.product.edit', compact('categories', 'products', 'subCategories', 'childCategories', 'brands'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'image' => ['nullable', 'image', 'max:3000'],
            'name' => ['required', 'max:200'],
            'category' => ['required'],
             'brand' => ['required'],
            'price' => ['required'],
            'qty' => ['required'],
            'short_description' => ['required', 'max:600'],
            'long_description' => ['required'],
            'seo_title' => ['max:200', 'nullable'],
            'seo_description' => ['max:250', 'nullable'],
            'status' => ['required']
        ]);

        $products = Products::findOrFail($id);
        if ($products->vendor_id != Auth::user()->vendor->id) {
            abort(404);
        }
        $imagePath = $this->updateImage($request, 'image', 'uploads', $products->thumb_image);
        $products->thumb_image = empty(!$imagePath) ? $imagePath : $products->thumb_image;
        $products->name = $request->name;
        $products->slug = Str::slug($request->name);
        $products->vendor_id =Auth::user()->vendor->id;
        $products->category_id = $request->category;
        $products->sub_category_id = $request->sub_category;
        $products->child_category_id = $request->child_category;
        $products->brand_id = $request->brand;
        $products->qty = $request->qty;
        $products->short_description = $request->short_description;
        $products->long_description = $request->long_description;
        $products->video_link = $request->video_link;
        $products->sku = $request->sku;
        $products->price = $request->price;
        $products->offer_price = $request->offer_price;
        $products->offer_start_date = $request->offer_start_date;
        $products->offer_end_date = $request->offer_end_date;
        $products->product_type = $request->product_type;
        $products->status = $request->status;
        $products->is_approved = $products->is_approved;
        $products->seo_title = $request->seo_title;
        $products->seo_description = $request->seo_description;
        $products->save();

        toastr('Updated Successfully', 'success');
        return redirect()->route('vendor.products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Products::findOrFail($id);
        if ($product->vendor_id != Auth::user()->vendor->id) {
            abort(404);
        }
        // Delelte Main image
        $this->deleteImage($product->thumb_image);

        // Delete Image Gallery
        $galleryImages = ProductImageGallery::where('product_id', $product->id)->get();
        foreach($galleryImages as $image) {
            $this->deleteImage($image->image);
            $image->delete();
        }

        $variants = ProductVariant::where('product_id', $product->id)->get();
        foreach($variants as $variant) {
            $variant->productVariantItems()->delete();
            $variant->delete();
        }

        $product->delete();

        return response(['status' => 'success', 'message' => 'Delete Successfully']);
    }
    public function changeStatus(Request $request ) {
        $product = Products::findOrFail($request->id);
        $product->status = $request->status == 'true' ? 1 : 0;
        $product->save();

        return response(['message' => 'Status has been updated']);
    }
    public function getSubCategories(Request $request) {
        $subCategories = SubCategory::where('category_id', $request->id)->get();
        return $subCategories;
    }
    public function getChildCategories(Request $request) {
        $childCategories = ChildCategory::where('sub_category_id', $request->id)->get();
        return $childCategories;
    }
}