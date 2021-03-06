<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ration;
class Favorite extends Model
{
    use HasFactory;
    protected $table = 'favorites';
    protected $fillable = ['user_id','ration_id'];
    public $timestamps = false;

    public function favName()
    {
        return $this->belongsTo(Ration::class, 'ration_id');
    }
}
