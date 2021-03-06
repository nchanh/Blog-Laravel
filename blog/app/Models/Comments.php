<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;

    //comments table in database
    protected $guarded = [];

    // user who has commented
    public function author()
    {
        return $this->belongsTo(User::class, 'from_user');
    }

    // returns post of any comment
    public function post()
    {
        return $this->belongsTo(Posts::class, 'on_post');
    }
}
