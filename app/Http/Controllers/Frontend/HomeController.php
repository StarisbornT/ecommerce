<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Slider;
use App\Models\FlashSale;
use Illuminate\Http\Request;
use App\Models\FlashSaleItem;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index() {
        $sliders = Slider::where('status', 1)->orderBy('serial', 'asc')->get();
        $flashSaleDate = FlashSale::first();
        $flashSaleItem = FlashSaleItem::where('show_at_home', 1)->where('status', 1)->get();
        return view('frontend.home.home',
        compact('sliders', 'flashSaleDate', 'flashSaleItem'));
    }
}