<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AnimalController extends Controller
{
    public function index()
    {
        $user = User::whereId(Auth::user()->id)->with('desc')->first(); 
        return view('animals.list',compact('user'));
    }
}
