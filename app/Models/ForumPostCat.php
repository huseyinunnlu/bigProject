<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AltCategory;
use App\Models\MainCategory;
use App\Models\ForumPost;

class ForumPostCat extends Model
{
    use HasFactory;
    protected $table = 'forum_post_cats';
    protected $fillable = ['main_cat_id','alt_cat_id','post_id'];
    public $timestamps = false;

    public function altCatName()
    {
        return $this->belongsTo(AltCategory::class, 'main_cat_id');
    }
    public function mainCatName()
    {
        return $this->belongsTo(MainCategory::class, 'alt_cat_id');
    }
    public function postcontent()
    {
        return $this->belongsTo(ForumPost::class, 'post_id');
    }
}
