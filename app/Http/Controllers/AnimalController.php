<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Animal;
use App\Models\Milk;
use Carbon\Carbon;


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
        ->with('milk')->paginate(10) ?? abort(404);
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
            'birth'=>'required|date|before:'.date("Y-m-d H:i:s",),
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

    public function getAnimal(Request $request,$id)
    {   
        $order = 'desc';
        if($request->order){
            if ($request->order=='true') {
                $order = 'desc';
            }else{
                $order = 'asc';
            }
        }
        $date = '';
        $date = date("Y-m-d H:i:s", strtotime($request->select));
        if($request->select == null){
            $milk = Milk::where('animal_id',$id)->whereBetween('date', [$date,date("Y-m-d H:i:s"), strtotime("Today")])->orderBy('milk',$order)->get();
        }
        if($request->date1){
            $request->date1 = $request->date1.' '.'00:00:00';
            if(!$request->date2){
                $request->date2 = date("Y-m-d H:i:s");
            }
            $milk = Milk::where('animal_id',$id)->whereBetween('date', [$request->date1, $request->date2])->orderBy('milk',$order)->get();
        }else{ 
            $milk = Milk::where('animal_id',$id)->orderBy('milk',$order)->get();
        }
        $animal = Animal::whereId($id)->first() ?? abort(404);
        return response()->json([$animal,$milk]);
    }

    public function update(Request $request,$id)
    {
        $request->validate([
            'name'=>'nullable|max:50',
            'earring'=>'nullable|max:20',
            'strap'=>'nullable|max:11',
            'type'=>'nullable',
            'gender'=>'nullable',
            'birth'=>'nullable|date|before:today',
            'death'=>'nullable|date|before:today',
        ]);
        if($request->hasFile('image')){
            $key = '';
            $keys = array_merge(range('a', 'z'), range('A', 'Z'));
            for($i=0; $i < 10; $i++) {
                $key .= $keys[array_rand($keys)];
            }
            $filename = $key.'.'.$request->image->extension();
            $filenameWithUpload = '/uploads/'.$filename;
            $request->image->move(public_path('uploads'),$filename);
            $request->merge([
                'image'=>$filenameWithUpload
            ]);
        }
        $animal = Animal::whereId($id)->first()->update($request->post()) ?? abort(404);
    }

    public function storeMilk(Request $request,$id)
    {
        $request->validate([
            'user_id'=>'required',
            'animal_id'=>'required',
            'milk'=>'required|max:2',
            'protein'=>'nullable',
            'fat'=>'nullable',
            'date'=>'required|date|before:today',
        ]);
        Milk::where('user_id',$request->user_id)->where('animal_id',$request->animal_id)
        ->create([
            'user_id'=>$request->user_id,
            'animal_id'=>$id,
            'milk'=>$request->milk,
            'protein'=>$request->protein,
            'fat'=>$request->fat,
            'date'=>$request->date,
        ]);
    }

    public function destroyMilk($id)
    {
        $milk = Milk::whereId($id)->first();
        $milk->delete();
    }

}
