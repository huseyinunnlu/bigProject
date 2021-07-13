<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Animal;
use App\Models\Milk;
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
}
