<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserDesc;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProfileController extends Controller
{   
    public function index($id,$slug)
    {   
        $user = User::whereId(Auth::user()->id)->with('desc')->first();
        User::whereId($id)->whereSlug($slug)->first() ?? abort(404);
        $userid = $id;
        return view('profile.profile',compact('userid','user')); 
    }

    public function getUser($id)
    {
        $user = User::whereId($id)->first() ?? abort(404);
        return response()->json($user);
    }

    public function getDesc($id)
    {
        $userdesc = UserDesc::where('user_id',$id)->first();
        return response()->json($userdesc);
    }

    public function addDesc(Request $request,$id)
    {
        $desc = UserDesc::where('user_id',$id)->first();
        if(empty($desc)){
            UserDesc::create([
                'user_id'=>$id,
                'image'=>$request->image,
                'bio'=>null,
                'gender'=>null,
            ]);
        }
    }
    public function updateDesc(Request $request, $id)
    {
        $request->validate([
            'bio'=>'max:255|nullable'
        ]);
        $userdesc = UserDesc::where('user_id',$id)->first();
        $userdesc->update([
            'bio'=>$request->bio,
            'gender'=>$request->gender,
        ]);
    }

    public function updateimg(Request $request, $id)
    {
        $request->validate([
            'image'=>'required|file|mimes:jpg,jpeg,png'
        ]);
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

        $userdesc = UserDesc::where('user_id',$id)->first();
        $userdesc->update($request->post());
    }
    
    public function updateSettings(Request $request, $id)
    {
        $request->validate([
            'name'=>'max:255',
            'email'=>'required|email|unique:users,email,'.$request->id,
        ]);
        $slug = Str::of($request->name)->slug('-');
        $user = User::find($id)->update([
            'name'=>$request->name,
            'slug'=>$slug,
            'email'=>$request->email,
            'acctype'=>$request->acctype,
        ]);
        $user = User::whereId($id)->first();
        return redirect()->route('profile',[$id,$user->slug]);
    }
}
