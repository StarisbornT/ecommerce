<?php

namespace App\Http\Controllers\Frontend;

use Cart;
use App\Models\Coupon;
use App\Models\Products;
use Illuminate\Http\Request;
use App\Models\ProductVariantItem;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function cartDetails() {
        $cartItems = Cart::content();
        if(count($cartItems) == 0) {
            Session::forget('coupon');
            toastr('Add products in your Cart', 'warning', 'Cart is empty');
            return redirect()->route('home');
        }
        return view('frontend.pages.cart-detail', compact('cartItems'));
    }
    public function addToCart(Request $request) {
        $product = Products::findOrFail($request->product_id);

        // Check product quantity
        if($product->qty == 0) {
            return response(['status' => 'error', 'message' => 'Product Stocked Out']);
        }elseif($product->qty < $request->qty) {
            return response(['status' => 'error', 'message' => 'Quantity not available in stock']);
        }

        $variants = [];
        $variantTotalAmount = 0;

        if($request->has('variant_items')) {

            foreach($request->variant_items as $item_id) {
                $variantItem = ProductVariantItem::find($item_id);
                $variants[$variantItem->productVariant->name]['name'] = $variantItem->name;
                $variants[$variantItem->productVariant->name]['price'] = $variantItem->price;
                $variantTotalAmount += $variantItem->price;
            }
        }

        $productPrice = 0;
        if(checkDiscount($product)) {
            $productPrice += $product->offer_price ;
        }else {
            $productPrice = $product->price;
        }

        $cartData = [];
        $cartData['id'] = $product->id;
        $cartData['name'] = $product->name;
        $cartData['qty'] = $request->qty;
        $cartData['price'] = $productPrice;
        $cartData['weight'] = 10;
        $cartData['options']['variant_items'] = $variants;
        $cartData['options']['variants_total'] = $variantTotalAmount;
        $cartData['options']['image'] = $product->thumb_image;
        $cartData['options']['slug'] = $product->slug;


        Cart::add($cartData);

        return response(['status' => 'success', 'message' => 'Added to cart successfully']);
    }



    public function updateProductQuantity(Request $request) {
        $productId = Cart::get($request->rowId)->id;
        $product = Products::findOrFail($productId);
        if($product->qty == 0) {
            return response(['status' => 'error', 'message' => 'Product Stocked Out']);
        }elseif($product->qty < $request->qty) {
            return response(['status' => 'error', 'message' => 'Quantity not available in stock']);
        }
        Cart::update($request->rowId, $request->quantity);
        $productTotal = $this->getProductTotal($request->rowId);
        return response(['status' => 'success', 'message' => 'Product Quantity Updated', 'product_total' => $productTotal]);
    }

    public function getProductTotal($rowId) {
        $product = Cart::get($rowId);
        $total = ($product->price + $product->options->varaints_total) * $product->qty;
        return $total;
    }

    public function CartTotal() {
     $total = 0;
     foreach(Cart::content() as $product) {
        $total += $this->getProductTotal($product->rowId);
     }

     return $total;
    }

    public function clearCart() {
        Cart::destroy();

        return response(['status' => 'success', 'message' => 'Cart cleared successfully']);
    }

    public function removeProduct($rowId) {
        Cart::remove($rowId);
        toastr('Product removed successfully', 'success', 'Success');
        return redirect()->back();
    }

    public function getCartCount() {
        return Cart::content()->count();
    }

    public function getCartProduct() {
        return Cart::content();
    }

    public function removeSidebarProduct(Request $request) {
        Cart::remove($request->rowId);
        return response(['status' => 'success', 'message' =>'Removed Successfully']);
    }

    public function applyCoupon(Request $request) {
        if($request->coupon_code == null) {
            return response(['status' => 'error', 'message' => 'Coupon field is required']);
        }

        $coupon = Coupon::where(['code' => $request->coupon_code,'status' => 1])->first();

        if ($coupon == null) {
            return response(['status' => 'error', 'message' => 'Coupon not exist']);
        }elseif($coupon->start_date > date('Y-m-d')) {
            return response(['status' => 'error', 'message' => 'Coupon not exist']);
        }elseif($coupon->end_date < date('Y-m-d')) {
            return response(['status' => 'error', 'message' => 'Coupon has expired']);
        }elseif($coupon->total_used >= $coupon->quantity) {
            return response(['status' => 'error', 'message' => 'You cannot use the coupon again']);
        }

        if($coupon->discount_type == 'amount') {
            Session::put('coupon', [
            'coupon_name' => $coupon->name,
            'coupon_code' => $coupon->code,
            'discount_type' => 'amount',
            'discount_value' => $coupon->discount_value,
            ]);
        }elseif($coupon->discount_type == 'percent') {
            Session::put('coupon', [
            'coupon_name' => $coupon->name,
            'coupon_code' => $coupon->code,
            'discount_type' => 'amount',
            'discount_value' => $coupon->discount_value,
            ]);
        }

        return response(['status' => 'success', 'message' => 'Coupon applied successfully']);
    }

    // calculate coupon discount

    public function couponCalculation() {
        if(Session::has('coupon')) {
            $coupon = Session::get('coupon');
            if($coupon['discount_type'] == 'amount') {
                $total = getCartTotal() - $coupon['discount_value'];
                return response(['status' => 'success', 'cart_total' => $total, 'discount' => $coupon['discount_value']]);
            }elseif($coupon['discount_type'] == 'percent') {
                $discount = getCartTotal() - (getCartTotal() * $coupon['discount_value'] / 100);
                $total = getCartTotal() - $discount;
                return response(['status' => 'success', 'cart_total' => $total, 'discount' => $discount]);

            }
        }else {
            $total = getCartTotal();
            return response(['status' => 'success', 'cart_total' => $total, 'discount' => 0]);
        }
    }
}