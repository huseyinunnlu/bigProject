<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RationType;
use App\Models\RatFood;
use App\Models\Ration;
use App\Models\RatContent;
use App\Models\User;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class FRationController extends Controller
{

    public function index()
    {
        $user = User::whereId(Auth::user()->id)->with('desc')->first();
        return view('rations.list',compact('user'));
    }
    public function getSelectedType(Request $request)
    {
        $type = RationType::whereId($request->id)->first();
        return response()->json($type);        
    }

    public function getFood()
    {
        $foods = RatFood::get();
        return response()->json($foods);
    }

    public function addRation(Request $request)
    {
        $request->validate([
            'name'=>'required|max:255',
            'user_id'=>'required',
            'rat_type_id'=>'required',
            'sumfood'=>'required|between:1,1000.99',
            'price'=>'nullable|between:0,10000.99',
            'desc'=>'nullable|max:255',
        ]);
        Ration::create([
            'name'=>$request->name,
            'user_id'=>$request->user_id,
            'rat_type_id'=>$request->rat_type_id,
            'energy'=>$request->energy,
            'protein'=>$request->protein,
            'drym'=>$request->drym,
            'ca'=>$request->ca,
            'p'=>$request->p,
            'nacl'=>$request->nacl,
            'sumfood'=>$request->sumfood,
            'price'=>$request->price,
            'desc'=>$request->desc,
        ]);
        
        $rat_id = Ration::where('user_id',$request->user_id)->orderBy('created_at','desc')->first();
        if($request->food1 != null){
            RatContent::create([
                'ration_id'=>$rat_id->id,
                'food_id'=>$request->food1,
                'amount'=>$request->foodAmount1,
                'price'=>$request->foodPrice1,
            ]);
        }
        if($request->food2 != null){
            RatContent::create([
                'ration_id'=>$rat_id->id,
                'food_id'=>$request->food2,
                'amount'=>$request->foodAmount2,
                'price'=>$request->foodPrice2,
            ]);
        }
        if($request->food3 != null){
            RatContent::create([
                'ration_id'=>$rat_id->id,
                'food_id'=>$request->food3,
                'amount'=>$request->foodAmount3,
                'price'=>$request->foodPrice3,
            ]);
        }
        if($request->food4 != null){
            RatContent::create([
                'ration_id'=>$rat_id->id,
                'food_id'=>$request->food4,
                'amount'=>$request->foodAmount4,
                'price'=>$request->foodPrice4,
            ]);
        }
        if($request->food5 != null){
            RatContent::create([
                'ration_id'=>$rat_id->id,
                'food_id'=>$request->food5,
                'amount'=>$request->foodAmount5,
                'price'=>$request->foodPrice5,
            ]);
        }
        if($request->food6 != null){
            RatContent::create([
                'ration_id'=>$rat_id->id,
                'food_id'=>$request->food6,
                'amount'=>$request->foodAmount6,
                'price'=>$request->foodPrice6,
            ]);
        }
        if($request->food7 != null){
            RatContent::create([
                'ration_id'=>$rat_id->id,
                'food_id'=>$request->food7,
                'amount'=>$request->foodAmount7,
                'price'=>$request->foodPrice7,
            ]);
        }
        if($request->food8 != null){
            RatContent::create([
                'ration_id'=>$rat_id->id,
                'food_id'=>$request->food8,
                'amount'=>$request->foodAmount9,
                'price'=>$request->foodPrice9,
            ]);
        }
        if($request->food10 != null){
            RatContent::create([
                'ration_id'=>$rat_id->id,
                'food_id'=>$request->food10,
                'amount'=>$request->foodAmount10,
                'price'=>$request->foodPrice10,
            ]);
        }
        if($request->food11 != null){
            RatContent::create([
                'ration_id'=>$rat_id->id,
                'food_id'=>$request->food11,
                'amount'=>$request->foodAmount11,
                'price'=>$request->foodPrice11,
            ]);
        }
        if($request->food12 != null){
            RatContent::create([
                'ration_id'=>$rat_id->id,
                'food_id'=>$request->food12,
                'amount'=>$request->foodAmount12,
                'price'=>$request->foodPrice12,
            ]);
        }
    }


    public function list(Request $request)
    {   
        $order = 'desc';
        if(!$request->order){
            $order = 'desc';
        }else{
            $order = $request->order;
        }
        if($request->get == 'my'){
           $rations = Ration::with('user','type')->withCount('food','favs')->where('name','like','%'.$request->search.'%')->where('user_id',$request->userid)->orderBy('favs_count',$order)->paginate(15); 
       }elseif ($request->get == 'fav') {
        $favs = Favorite::where('user_id',$request->userid)->select('ration_id')->get();
        $ids = [];
        foreach($favs as $fav){
            array_push($ids, strval($fav->ration_id));
        }
        $rations = Ration::with('user','type')->withCount('food','favs')->where('name','like','%'.$request->search.'%')->whereIn('id',$ids)->orderBy('favs_count',$order)->paginate(15);
    }else{
        $rations = Ration::with('user','type')->withCount('food','favs')->where('name','like','%'.$request->search.'%')->orderBy('favs_count',$order)->paginate(15);
    }

    return response()->json($rations);
}

public function getRation($id)
{
   $ration = Ration::whereId($id)->with('user','type','food.name')->withCount('food','favs')->first();
   return response()->json($ration);
}

public function deleteRation($id)
{
   Ration::whereId($id)->delete();
}

public function addFav(Request $request)
{
    $fav = Favorite::where('user_id',$request->user_id)->where('ration_id',$request->ration_id)->first();
    if(empty($fav)){
        $request->validate([
            'user_id'=>'required',
            'ration_id'=>'required',
        ]);
        Favorite::create([
            'user_id'=>$request->user_id,
            'ration_id'=>$request->ration_id,
        ]);
    }
}

public function myFav(Request $request)
{
    $fav = Favorite::where('user_id',$request->user_id)->where('ration_id',$request->rat_id)->first();
    return response()->json($fav);

}

public function deleteFav($id)
{
    Favorite::whereId($id)->delete();
}

public function getRat($id)
{
    $ration = Ration::whereId($id)->select('id','name','desc')->first();
    return response()->json($ration);
}

public function updateRation(Request $request,$id)
{
    $request->validate([
        'name'=>'required|max:255',
        'desc'=>'nullable|max:255',
    ]);
    Ration::whereId($id)->first()->update([
        'name'=>$request->name,
        'desc'=>$request->desc,
    ]);
}
}

