<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    function user(){
        return view('user/index');
    }
    function admin(){
        return view('admin/index');
    }
}
