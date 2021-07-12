<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ration;
use App\Models\RatFood;

class AnimalRat extends Model
{
    use HasFactory;
    protected $table = 'animal_rats';
    protected $fillable = ['animal_id','ration_id'];
    public $timestamps = false;

    public function name()
    {
        return $this->belongsTo(Ration::class, 'ration_id');
    }

    public function foodName()
    {
        return $this->hasOne(RatFood::class, 'id');
    }
}
