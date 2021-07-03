<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\RatFood;
use App\Models\RationType as RatType;

class RationController extends Controller
{
    public function index()
    {
        $user = User::whereId(Auth::user()->id)->with('desc')->first();
        return view('adminpanel.rations.list',compact('user'));
    }

    public function addFood(Request $request)
    {
        $request->validate([
            'name'=>'required|max:255',
            'drym'=>'required|between:0,1000.99',
            'energy'=>'required|between:0,1000.99',
            'protein'=>'required|between:0,1000.99',
            'dp'=>'required|between:0,1000.99',
            'bp'=>'required|between:0,1000.99',
            'cel'=>'required|between:0,1000.99',
            'fat'=>'required|between:0,1000.99',
            'ash'=>'required|between:0,1000.99',
            'ca'=>'required|between:0,1000.99',
            'p'=>'required|between:0,1000.99',
            'na'=>'required|between:0,1000.99',
            'k'=>'required|between:0,1000.99',
            's'=>'required|between:0,1000.99',
            'cl'=>'required|between:0,1000.99',
        ]);
        RatFood::create($request->post());
    }

    public function getFoods(Request $request)
    {
        $foods = RatFood::where('name','like','%'.$request->search.'%')->paginate(20);
        return response()->json($foods);
    }

    public function deleteFood($id)
    {
        RatFood::whereId($id)->delete();
    }

    public function getFood($id)
    {
        $food = Ratfood::whereId($id)->first();
        return response()->json($food);
    }

    public function updateFood(Request $request, $id)
    {
        $request->validate([
            'name'=>'required|max:255',
            'drym'=>'required|between:0,1000.99',
            'energy'=>'required|between:0,1000.99',
            'protein'=>'required|between:0,1000.99',
            'dp'=>'required|between:0,1000.99',
            'bp'=>'required|between:0,1000.99',
            'cel'=>'required|between:0,1000.99',
            'fat'=>'required|between:0,1000.99',
            'ash'=>'required|between:0,1000.99',
            'ca'=>'required|between:0,1000.99',
            'p'=>'required|between:0,1000.99',
            'na'=>'required|between:0,1000.99',
            'k'=>'required|between:0,1000.99',
            's'=>'required|between:0,1000.99',
            'cl'=>'required|between:0,1000.99',
        ]);
        RatFood::whereId($id)->first()->update($request->post());
    }

    public function addType(Request $request)
    {
        $request->validate([
            'name'=>'required|max:255',
            'energy'=>'required|between:0,1000.99',
            'protein'=>'required|between:0,1000.99',
            'drym'=>'required|between:0,1000.99',
            'ca'=>'required|between:0,1000.99',
            'p'=>'required|between:0,1000.99',
            'nacl'=>'required|between:0,1000.99',
        ]);
        RatType::create([
            'name'=>$request->name,
            'energy'=>$request->energy,
            'protein'=>$request->protein,
            'drym'=>$request->drym,
            'ca'=>$request->ca,
            'p'=>$request->p,
            'nacl'=>$request->nacl,
        ]);
    }

    public function getTypes(Request $request)
    {
        $types = RatType::where('name','like','%'.$request->typesearch.'%')->paginate(20);
        return response()->json($types);
    }

    public function deleteType($id)
    {
        RatType::whereId($id)->delete();
    }

     public function getType($id)
    {
        $type = RatType::whereId($id)->first();
        return response()->json($type);
    }

    public function updateType(Request $request,$id)
    {
        $request->validate([
            'name'=>'required|max:255',
            'energy'=>'required|between:0,1000.99',
            'protein'=>'required|between:0,1000.99',
            'drym'=>'required|between:0,1000.99',
            'ca'=>'required|between:0,1000.99',
            'p'=>'required|between:0,1000.99',
            'nacl'=>'required|between:0,1000.99',
        ]);
        RatType::whereId($id)->first()->update([
            'name'=>$request->name,
            'energy'=>$request->energy,
            'protein'=>$request->protein,
            'drym'=>$request->drym,
            'ca'=>$request->ca,
            'p'=>$request->p,
            'nacl'=>$request->nacl,
        ]);
    }
}
