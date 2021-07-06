<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RatContent extends Model
{
    use HasFactory;
    protected $table = 'rat_contents';
    protected $fillable = ['ration_id','food_id','amount','price'];
    public $timestamps = false;
}
