<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function index() {
        $profile = User::findOrFail(Auth::user()->id);
        return view('frontend.dashboard.dashboard', compact('profile'));
    }
}