<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use App\Models\ForumPostCat;


class ForumPost extends Model
{
    use Sluggable;
    use HasFactory;
    protected $table = 'forum_posts';
    protected $fillable = ['title','slug','user_id','status'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
    public function postCat()
    {
        return $this->hasOne(ForumPostCat::class, 'post_id');
    }
}
