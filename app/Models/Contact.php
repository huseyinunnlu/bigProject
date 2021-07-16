<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Answer;

class Contact extends Model
{
    use HasFactory;
    protected $table = 'contacts';
    protected $fillable = ['user_id','subject','message','type','status'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function answer()
    {
        return $this->hasMany(Answer::class, 'contact_id');
    }
}
