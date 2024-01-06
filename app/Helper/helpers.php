<?php

use Illuminate\Support\Facades\Session;

// Set sidebar item active

function setActive(array $route) {
    if(is_array($route)) {
        foreach($route as $r) {
            if(request()->routeIs($r)) {
                return 'active';
            }
        }
    }
}

// Check if product has discount

function checkDiscount($product) {
    $currentDate = date('Y-m-d');
    if($product->offer_price > 0 && $currentDate >= $product->offer_start_date && $currentDate <= $product->offer_end_date) {
        return true;
    }
    return false;
}

// Calculate discount percent

function calculateDiscountPercent($originalPrice, $discountPrice) {
    $discountAmount = $originalPrice - $discountPrice;
    $discountPercent = ($discountAmount / $originalPrice) * 100;
    return $discountPercent;
}

// Check the product type
function productType(string $type) {
    switch($type) {
        case 'new_arrival':
            return 'New';
            break;

    case 'featured_product':
        return 'Featured';
        break;
    case 'top_product':
        return 'Top';
        break;
    case 'best_product':
        return 'Best';
        break;
    default:
        return '';
        break;
    }
}

// get total cart amount
function getCartTotal() {
    $total = 0;
    foreach(\Cart::content() as $product) {
       $total += ($product->price + $product->options->variants_total) * $product->qty;
    }
    return $total;
}

function getMainCartTotal() {
    if(Session::has('coupon')) {
        $coupon = Session::get('coupon');
        if($coupon['discount_type'] == 'amount') {
            $total = getCartTotal() - $coupon['discount_value'];
            return $total;
        }elseif($coupon['discount_type'] == 'percent') {
            $discount = getCartTotal() - (getCartTotal() * $coupon['discount_value'] / 100);
            $total = getCartTotal() - $discount;
            return $total;
        }
    }else {
        return getCartTotal();
    }
}

function getCartDiscount() {
    if(Session::has('coupon')) {
        $coupon = Session::get('coupon');
        if($coupon['discount_type'] == 'amount') {
           return $coupon['discount_value'];
        }elseif($coupon['discount_type'] == 'percent') {
            $discount = getCartTotal() - (getCartTotal() * $coupon['discount_value'] / 100);

            return $discount;
        }
    }else {
        return 0;
    }
}

function getShippingFee() {
    if(Session::has('shipping_method')) {
        return Session::get('shipping_method')['cost'];
    }else {
        return 0;
    }
}

function getFinalPayableAmount() {
    return getMainCartTotal() + getShippingFee();
}


?>