<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RatFood extends Model
{
    use HasFactory;
    protected $table = 'rat_food';
    protected $fillable = ['name','drym','energy','protein','dp','bp','cel','fat','ash','ca','p','na','k','s','cl'];
    public $timestamps = false;
}
