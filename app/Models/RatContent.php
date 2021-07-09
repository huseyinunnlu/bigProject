<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\RatFood;

class RatContent extends Model
{
    use HasFactory;
    protected $table = 'rat_contents';
    protected $fillable = ['ration_id','food_id','amount','price'];
    public $timestamps = false;

    public function name()
    {
        return $this->belongsTo(RatFood::class, 'food_id');
    }
}
