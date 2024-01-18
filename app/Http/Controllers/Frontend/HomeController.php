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

        return view('frontend.home.home');
    }
}
