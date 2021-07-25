<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\MainCategory;
use App\Models\ForumPost;
use App\Models\ForumPostCat;
use App\Models\AltCategory;
use App\Models\ForumPostMessage;

class ForumController extends Controller
{
    public function index()
    {
        $user = User::whereId(Auth()->user()->id)->with('desc')->first() ?? abort(404); 
        $categories = MainCategory::where('status','active')->with('altCat')->get();
        $catPosts = MainCategory::where('status','active')->with('altcat.lastpost.postcontent.user.desc')->withCount('postCount')->get();

        return view('forum.index',compact('user','categories','catPosts'));
    }

    public function storePost(Request $request)
    {
        $request->validate([
            'title'=>'required|max:255|min:10',
            'content'=>'required|min:10|max:10000',
            'category'=>'required',
        ]);
        if(Auth()->user()){
            ForumPost::create([
                'title'=>$request->title,
                'user_id'=>Auth()->user()->id,
                'content'=>$request->content,
            ]);
            $cats = explode(',', $request->category);
            $postid = ForumPost::where('user_id',Auth()->user()->id)->orderBy('created_at','desc')->select('id')->first();
            ForumPostMessage::create([
                'user_id'=>Auth()->user()->id,
                'post_id'=>$postid->id,
                'content'=>$request->content,
            ]);
            ForumPostCat::create([
                'main_cat_id'=> $cats[0],
                'alt_cat_id'=>$cats[1],
                'post_id'=>$postid->id,
            ]);
            return redirect()->back();
        }else{
            return redirect()->back()->with('message','You Have a Error');
        }
    }

    public function getPosts()
    {
        return $posts = ForumPost::where('status','active')->with('user.desc','postcat.altcatname')->orderBy('created_at','desc')->get();
        return response()->json($posts);
    }

    public function postArticle($slug,$id)
    {
        $user = User::whereId(Auth()->user()->id)->with('desc')->first() ?? abort(404);
        $post = ForumPost::whereSlug($slug)->with('user.desc','postcat.altcatname','postcat.maincatname')->whereId($id)->first() ?? abort(404);
        return view('forum.postArticle',compact('user','post'));
    }
    public function getMessages($id)
    {
        $messages = ForumPostMessage::where('post_id',$id)->with('user.desc','user.follow')->paginate(15) ?? abort(404);
        foreach($messages as $message){
            $message->user->followCount = count($message->user->follow);
        }
        return response()->json($messages);
    }

    public function addMessage(Request $request,$id)
    {
        $request->validate([
            'user_id'=>'required',
            'content'=>'required|max:15000',
        ]);
        ForumPostMessage::create([
            'user_id'=>$request->user_id,
            'post_id'=>$id,
            'content'=>$request->content,
        ]);
    }
}