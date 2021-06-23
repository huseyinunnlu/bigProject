<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

class IndexController extends Controller
{   
    public function welcome()
    {
        if(Auth::user()){
            $user = User::whereId(Auth::user()->id)->with('desc')->first(); 
        }else{
            $user = null;
        }
        return view('welcome',compact('user'));
    }
    public function dashboard()
    {
        $user = User::whereId(Auth::user()->id)->with('desc')->first();
        return view('dashboard',compact('user'));
    }
}
