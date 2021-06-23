<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::whereId(Auth::user()->id)->with('desc')->first();
        return view('adminpanel.users.list',compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list(Request $request)
    {   
        if($request->type){
            $users = User::where('name','like','%'.$request->search.'%')
            ->where('email','like','%'.$request->search.'%')
            ->where('type',$request->type)->get();
        }else{
            $users = User::where('name','like','%'.$request->search.'%')
            ->orwhere('email','like','%'.$request->search.'%')->get();
        }
        return response()->json($users);
    }

    public function userDetail($id)
    {
        $user = User::whereId($id)->first();
        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id)->update($request->post());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::whereId($id)->first();
        $user->delete();
    }
}
