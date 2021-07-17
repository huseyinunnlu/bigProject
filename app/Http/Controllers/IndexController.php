<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Animal;
use App\Models\Milk;
use App\Models\Contact;
use App\Models\Answer;
use Carbon\Carbon;

class IndexController extends Controller
{   
    public function welcome()
    {
        if(Auth::user()){
            $user = User::whereId(Auth::user()->id)->with('desc')->first(); 
        }else{
            $user = null;
        }
        return view('welcome',compact('user'));
    }
    public function dashboard()
    {
        $user = User::whereId(Auth::user()->id)->with('desc')->first();
        $animalCount = Animal::where('user_id',Auth::user()->id)->select('type')->selectraw('count(*) as count')->groupBy('type')->get();
        foreach($animalCount as $ac){
            $ac->type = ucwords($ac->type);
            if ($ac->type != 'Cattle') {
                $ac->type = 'Sheeps And Goats';
            }
        }
        $today1 = date('Y-m-d');
        $today2 = date('Y-m-d', strtotime('+1 Day'));
        $mounth1 = Date('Y-m-01');
        $m = date('m');
        $m = $m+1;
        $m = '0'.$m;
        $mounth2 = Date('Y-'.$m.'-01');
        $year1 = date('Y-01-01');
        $year2 = date('Y-01-01', strtotime('+1 Years'));
        $sumDayMilk = Milk::where('user_id',Auth::user()->id)->whereBetween('date',[$today1 , $today2])->sum('milk');
        $sumMounthMilk = Milk::where('user_id',Auth::user()->id)->whereBetween('date',[$mounth1 , $mounth2])->sum('milk');
        $sumYearMilk = Milk::where('user_id',Auth::user()->id)->whereBetween('date',[$year1 , $year2])->sum('milk');
        return view('dashboard',compact('user','animalCount','sumDayMilk','sumMounthMilk','sumYearMilk'));
    }

    public function contact()
    {
        $user = User::whereId(Auth::user()->id)->with('desc')->first();
        $messages = Contact::where('user_id',Auth()->user()->id)->with('answer')->orderBy('status','desc')->orderBy('created_at','desc')->get();
        return view('contact', compact('user','messages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'subject'=>'required|max:100',
            'type'=>'required',
            'message'=>'required|max:255',
        ]);
        if(Auth()->user())
            Contact::create([
                'user_id'=>Auth()->user()->id,
                'type'=>$request->type,
                'subject'=>$request->subject,
                'message'=>$request->message,
            ]);

        return redirect()->route('contact.index')->withsuccess('Message Sended Successfully');
    }

    public function answerStore(Request $request)
    {
        $request->validate([
            'contact_id'=>'required',
            'message'=>'required|max:255',
        ]);
        $userid = Contact::whereId($request->contact_id)->select('user_id')->first();
        Answer::create([
            'user_id'=>Auth()->user()->id,
            'contact_id'=>$request->contact_id,
            'message'=>$request->message,
        ]);

        if(Auth()->user()->type == 'admin' || Auth()->user()->type == 'moderator'){
            if(Auth()->user()->id != $userid->user_id){
                Contact::whereId($request->contact_id)->first()->update([
                    'status'=>'answered',
                ]);
            }
        }
        return redirect()->back();
    }

    public function adminContactIndex()
    {
        $user = User::whereId(Auth::user()->id)->with('desc')->first();
        return view('adminpanel.contact', compact('user'));
    }

    public function adminGetContacts()
    {
        $messages = Contact::with('answer')->orderBy('status','desc')->orderBy('created_at','desc')->paginate(1);
        return response()->json($messages);
    }

    public function apiAnswerStore(Request $request)
    {
        $request->validate([
            'user_id'=>'required',
            'contact_id'=>'required',
            'message'=>'required|max:255',
        ]);
        $userid = Contact::whereId($request->contact_id)->with('user')->first();
        Answer::create([
            'user_id'=>$request->user_id,
            'contact_id'=>$request->contact_id,
            'message'=>$request->message,
        ]);

        
        if ($userid->user->type == 'admin' || $userid->user->type == 'moderator') {
            if ($request->user_id != $userid->user_id) {
                Contact::whereId($request->contact_id)->first()->update([
                    'status'=>'answered',
                ]); 
            }
        }
    }
}
