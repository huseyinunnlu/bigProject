<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\MainCategory;
use App\Models\AltCategory;

class AdminCategoryController extends Controller
{

    //Main Category
    public function forumMainCatList()
    {
        $user = User::whereId(Auth()->user()->id)->with('desc')->first() ?? abort(404);
        $categories = MainCategory::with('altCat')->withCount('altCat')->get(); 
        return view('adminpanel.forumcategory.forumCatList',compact('user','categories'));
    }
    public function forumMainCatCreate()
    {
        $user = User::whereId(Auth()->user()->id)->with('desc')->first() ?? abort(404); 
        return view('adminpanel.forumcategory.forumMainCatCreate',compact('user'));
    }
    public function forumMainCatStore(Request $request)
    {
        $request->validate([
            'title'=>'required|max:100',
            'status'=>'required',
        ]);
        MainCategory::create($request->post());
        return redirect()->route('admin.forum.cat.index')->withsuccess('Main Category Successfully Created');
    }
    public function forumMainCatUpdate(Request $request,$id)
    {
        $request->validate([
            'title'=>'required|max:100',
            'status'=>'required',
        ]);
        MainCategory::whereId($id)->first()->update($request->post());
        return redirect()->route('admin.forum.cat.index')->withsuccess('Main Category Successfully Updated');
    }
    public function forumMainCatEdit($id)
    {
        $user = User::whereId(Auth()->user()->id)->with('desc')->first() ?? abort(404); 
        $category = MainCategory::whereId($id)->first() ?? abort(404); 
        return view('adminpanel.forumcategory.forumMainCatEdit',compact('user','category'));
    }
    public function forumMainCatDelete($id)
    {
        MainCategory::whereId($id)->delete();
        return redirect()->route('admin.forum.cat.index')->withsuccess('Main Category Successfully Deleted');
    }

    //Alt Category

    public function forumAltCatCreate($id)
    {
        $user = User::whereId(Auth()->user()->id)->with('desc')->first() ?? abort(404); 
        $category = MainCategory::whereId($id)->select('id','title')->first() ?? abort(404); 
        return view('adminpanel.forumcategory.forumAltCatCreate',compact('user','category'));
    }

    public function forumAltCatStore(Request $request)
    {
        $request->validate([
            'main_cat_id'=>'required', 
            'title'=>'required|max:100',
            'status'=>'required',
        ]);
        AltCategory::create([
            'main_cat_id'=>$request->main_cat_id,
            'title'=>$request->title,
            'status'=>$request->status,
        ]);
        return redirect()->route('admin.forum.cat.index')->withsuccess('Alt Category Successfully Created');
    }

    public function forumAltCatEdit($id)
    {
        $user = User::whereId(Auth()->user()->id)->with('desc')->first() ?? abort(404); 
        $altCat = AltCategory::whereId($id)->first() ?? abort(404); 
        return view('adminpanel.forumcategory.forumAltCatEdit',compact('user','altCat'));
    }

    public function forumAltCatUpdate(Request $request,$id)
    {
        $request->validate([
            'title'=>'required|max:100',
            'status'=>'required',
        ]);
        AltCategory::whereId($id)->first()->update($request->post());
        return redirect()->route('admin.forum.cat.index')->withsuccess('Alt Category Successfully Updated');
    }

    public function forumAltCatDelete($id)
    {
        AltCategory::whereId($id)->delete();
        return redirect()->route('admin.forum.cat.index')->withsuccess('Alt Category Successfully Deleted');
    }

}