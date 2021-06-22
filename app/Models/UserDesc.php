<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDesc extends Model
{
    use HasFactory;
    protected $table = 'user_descs';
    protected $fillable = ['user_id','image','gender','bio'];
}
