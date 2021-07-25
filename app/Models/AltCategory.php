<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use App\Models\ForumPost;
use App\Models\ForumPostCat;

class AltCategory extends Model
{
    use HasFactory;
    use Sluggable;
    protected $table = 'alt_categories';
    protected $fillable = ['main_cat_id','title','status'];
    public $timestamps = false;
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function lastpost()
    {
        return $this->hasOne(ForumPostCat::class, 'alt_cat_id')->orderBy('id','desc');
    }
    public function mainCatName()
    {
        return $this->hasOne(ForumPostCat::class, 'id');
    }

    public function postcount()
    {
        return $this->belongsTo(ForumPostCat::class, 'alt_cat_id');
    }
}
