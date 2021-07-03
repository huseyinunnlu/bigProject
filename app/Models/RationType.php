<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RationType extends Model
{
    use HasFactory;
    protected $table = 'ration_types';
    protected $fillable = ['name','protein','energy','drym','ca','p','nacl'];
    public $timestamps = false;
}
