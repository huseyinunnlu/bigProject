<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AltCategory;
use App\Models\ForumPostCat;
use Cviebrock\EloquentSluggable\Sluggable;

class MainCategory extends Model
{
    use HasFactory;
    use Sluggable;
    protected $table = 'main_categories';
    protected $fillable = ['title','status'];
    public $timestamps = false;

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function altcat()
    {
        return $this->hasMany(AltCategory::class, 'main_cat_id');
    }
    public function postcount()
    {
        return $this->hasMany(ForumPostCat::class, 'main_cat_id');
    }
    public function lastpost()
    {
        return $this->hasOne(ForumPostCat::class, 'main_cat_id')->orderBy('id','desc');
    }
}
