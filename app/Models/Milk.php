<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Milk extends Model
{
    use HasFactory;
    protected $table = 'milks';
    protected $fillable = ['user_id','animal_id','milk','date','protein','fat'];
    public $timestamps = false;
}
