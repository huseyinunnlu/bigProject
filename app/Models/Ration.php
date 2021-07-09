<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\RatContent;
use App\Models\RationType;
use Auth;

class Ration extends Model
{
    use HasFactory;
    protected $table = 'rations';
    protected $fillable = ['name','user_id','rat_type_id','desc','energy','protein','drym','ca','p','nacl','sumfood','price','status'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function food()
    {
        return $this->hasMany(RatContent::class, 'ration_id');
    }
    public function type()
    {
        return $this->belongsTo(RationType::class, 'rat_type_id');
    }

    public function name(){
        return $this->hasOne('App\Models\RatFood'); 
    }

    public function favs()
    {
        return $this->hasMany('App\Models\Favorite');
    }
}
