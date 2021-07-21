<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AltCategory extends Model
{
    use HasFactory;
    protected $table = 'alt_categories';
    protected $fillable = ['main_cat_id','title','status'];
    public $timestamps = false;
}
