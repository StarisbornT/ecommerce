<?php

namespace App\Http\Controllers\Backend;

use App\Models\Products;
use App\Models\FlashSale;
use Illuminate\Http\Request;
use App\Models\FlashSaleItem;
use App\Http\Controllers\Controller;
use App\DataTables\FlashSaleItemDataTable;

class FlashSaleController extends Controller
{
    public function index(FlashSaleItemDataTable $dataTable) {
        $flashSaleDate = FlashSale::first();
        $products = Products::where('is_approved', 1)->where('status', 1)->OrderBy('id', 'DESC')->get();
        return $dataTable->render('admin.flash-sale.index', compact('flashSaleDate', 'products'));
    }

    public function update(Request $request) {
        $request->validate([
            'end_date' => ['required']
        ]);

        FlashSale::updateOrCreate(
            ['id' => 1],
            ['end_date' => $request->end_date]
        );

        toastr('Updated Successfully', 'success', 'Success');

        return redirect()->back();
    }

    public function addProduct(Request $request) {
        $request->validate([
            'product' => ['required', 'unique:flash_sale_items,product_id'],
            'show_at_home' => ['required'],
            'status' => ['required'],
        ], [
            'product.unique' => 'The Product is already in Flash Sale'
        ]);
        $flashSaleDate = FlashSale::first();
        $flashSaleItem = new FlashSaleItem();
        $flashSaleItem->product_id = $request->product;
        $flashSaleItem->flash_sale_id = $flashSaleDate->id;
        $flashSaleItem->show_at_home = $request->show_at_home;
        $flashSaleItem->status = $request->status;
        $flashSaleItem->save();

        toastr('Product Added Successfully', 'success');

        return redirect()->back();
    }

    public function showAtHome(Request $request) {
        $flashSaleItem = FlashSaleItem::findOrFail($request->id);
        $flashSaleItem->show_at_home = $request->status == 'true' ? 1 : 0;
        $flashSaleItem->save();

        return response(['message' => 'Updated Successfully']);
    }

    public function changeStatus(Request $request) {
        $flashSaleStatus = FlashSaleItem::findOrFail($request->id);
        $flashSaleStatus->status = $request->status == 'true' ? 1 : 0;
        $flashSaleStatus->save();

        return response(['message' => 'Updated Successfully']);
    }

    public function destroy(string $id) {
        $flashSaleStatus = FlashSaleItem::findOrFail($id);
        $flashSaleStatus->delete();
        return response(['status' => 'success', 'message' => 'Deleted Successfully']);
    }
}
