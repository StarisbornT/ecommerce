<?php

namespace App\Http\Controllers\Backend;

use App\Models\Products;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\SellerProductsDataTable;
use App\DataTables\SellerPendingProductsDataTable;

class SellerProductsController extends Controller
{
    public function index(SellerProductsDataTable $dataTable) {
        return $dataTable->render('admin.products.seller-product.index');
    }

    public function pendingProducts(SellerPendingProductsDataTable $dataTable) {
        return $dataTable->render('admin.products.seller-pending-product.index');
    }

    public function changeApprovedStatus(Request $request) {
        $product = Products::findOrFail($request->id);
        $product->is_approved = $request->value;
        $product->save();

        return response(['message' => 'Pending Product Updated Successfully', 'status' => 'success']);
    }
}
