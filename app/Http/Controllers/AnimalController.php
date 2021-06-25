<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Animal;

class AnimalController extends Controller
{
    public function index()
    {
        $user = User::whereId(Auth::user()->id)->with('desc')->first() ?? abort(404); 
        return view('animals.list',compact('user'));
    }

    public function list(Request $request)
    {
        if(!$request->type){           
            $types = ['cattle','shandgo']; 
        }else{
            $types[0] = $request->type;
        }
        if(!$request->gender){           
            $genders = ['male','female']; 
        }else{
            $genders[0] = $request->gender;
        }
        $animals=Animal::where('user_id',$request->user_id)
        ->where($request->col,$request->search)
        ->whereIn('type',$types)
        ->whereIn('gender',$genders)
        ->paginate(10) ?? abort(404);
        return response()->json($animals);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id'=>'required',
            'name'=>'nullable|max:50',
            'earring'=>'nullable|max:20',
            'strap'=>'nullable|max:11',
            'type'=>'required',
            'gender'=>'required',
            'birth'=>'required|date|before:today',
        ]);
        Animal::create([
            'user_id'=>$request->user_id,
            'name'=>$request->name,
            'earring'=>$request->earring,
            'strap'=>$request->strap,
            'type'=>$request->type,
            'gender'=>$request->gender,
            'birth'=>$request->birth,
        ]) ?? abort(404);
    }

    public function show()
    {
        $user = User::whereId(Auth::user()->id)->with('desc')->first() ?? abort(404);
        return view('animals.edit',compact('user'));
    }

}
