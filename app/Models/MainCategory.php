<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AltCategory;
class MainCategory extends Model
{
    use HasFactory;
    protected $table = 'main_categories';
    protected $fillable = ['title','status'];
    public $timestamps = false;

    public function altCat()
    {
        return $this->hasMany(AltCategory::class, 'main_cat_id');
    }
}
