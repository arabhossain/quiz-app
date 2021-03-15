<?php

namespace App\Http\Controllers;

use GPBMetadata\Google\Api\Auth;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index(){
        $user = auth()->user();
        return view('frontend.pages.profile', compact('user'));
    }
}
