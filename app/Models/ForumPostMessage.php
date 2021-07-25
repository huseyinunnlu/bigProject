<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForumPostMessage extends Model
{
    use HasFactory;
    protected $table = 'forum_post_messages';
    protected $fillable = ['user_id','post_id','content'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
