<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    use HasFactory;
    protected $table = 'animals';
    protected $fillable = ['user_id','strap','earring','name','image','birth','death','desc','type','gender'];

    public function milk()
    {
        return $this->hasMany('App\Models\Milk');
    }

    public function weight()
    {
        return $this->hasOne('App\Models\Weight')->orderBy('date','desc');
    }
}
