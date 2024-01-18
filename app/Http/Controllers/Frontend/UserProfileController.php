<?php

namespace App\Http\Controllers\Frontend;

use File;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserProfileController extends Controller
{
    public function index() {
        $profile = User::findOrFail(Auth::user()->id);
        return view('frontend.dashboard.profile', compact('profile'));
    }

}