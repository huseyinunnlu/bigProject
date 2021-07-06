<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ration extends Model
{
    use HasFactory;
    protected $table = 'rations';
    protected $fillable = ['name','user_id','rat_type_id','desc','energy','protein','drym','ca','p','nacl','sumfood','price','status'];
}
