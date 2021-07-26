<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    use HasFactory;

    //restricts columns from modifying
    protected $guarded = [];

    // posts has many comments
    // returns all comments on that post
    public function comments()
    {
        return $this->hasMany(Comments::class, 'on_post');
    }

    // returns the instance of the user who is author of that post
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
