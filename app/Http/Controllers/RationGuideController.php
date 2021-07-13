<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\AnimalRat;
use App\Models\Ration;
use App\Models\Animal;
class RationGuideController extends Controller
{
    public function index()
    {
        $user = User::whereId(Auth()->user()->id)->with('desc')->first();
        $animals = Animal::where('user_id',Auth()->user()->id)->select('id')->get() ?? abort(404);
        $ids = [];
        foreach($animals as $animal){
            array_push($ids, $animal->id);
        }        
        $guides = AnimalRat::whereIn('animal_id',$ids)->select('ration_id')->with('name.type','name.food.name')->selectraw('count(*) as count')->groupBy('ration_id')->get();
        foreach($guides as $guide){
            $guide->name->sumfood = $guide->name->sumfood * $guide->count;
            $sumprice = 0;
            foreach($guide->name->food as $food){
                $food->amount = $food->amount = $guide->count;
                $food->price = $food->price = $guide->count;
                $sumprice = $sumprice + $food->price;
            }
            $guide->sumprice = $sumprice;
            $guide->foodCount = count($guide->name->food);
        }
        return view('rations.guide',compact('user','guides'));
    }
}
