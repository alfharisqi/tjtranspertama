<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class SesiController extends Controller
{
    function index()
    {
        return view('/auth/login');
    }

    function login(Request $request){
        $request->validate([
            'email'=>'required',
            'password'=>'required'
        ],[
            'email.required'=>'Email wajib diisi',
            'password.required'=>'Password wajib diisi',
        ]);

        $infologin = [
            'email'=>$request->email,
            'password'=>$request->password,
        ];

        if(Auth::attempt($infologin)){
            if(Auth::user()->role == 'user'){
                return redirect('user');
            }elseif(Auth::user()->role == 'admin'){
                return redirect('admin');
            }
        } else {
            // return redirect('/')->withErrors('Username dan Password yang dimasukkan tidak sesusai')->withInput();
            return redirect()->back()->withErrors('Username dan Password yang dimasukkan tidak sesuai')->withInput();
        }

    }

    function logout()
    {
        Auth::logout();
        return redirect('');
    }



}
