<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Notifications\Notifiable;
use App\Enums\UserRole;

// use Authenticatable, CanResetPassword;
class User extends Authenticatable implements AuthenticatableContract, CanResetPasswordContract
{
    use HasFactory, Notifiable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // user has many posts
    public function posts()
    {
        return $this->hasMany(Posts::class, 'author_id');
    }

    // user has many comments
    public function comments()
    {
        return $this->hasMany('App\Comments', 'from_user');
    }

    # Checking if a user can post an article
    public function can_post()
    {
        if ($this->role === UserRole::getKey(0) || $this->role === UserRole::getKey(1))
        {
            return true;
        }
        return false;
    }

    # Checking if a role is admin
    public function is_admin()
    {
        return $this->role === UserRole::getKey(0);
    }

    # Checking if a role is author
    public function is_author()
    {
        return $this->role === UserRole::getKey(1);
    }

    # Checking if a role is subscriber
    public function is_subscriber()
    {
        return $this->role === UserRole::getKey(2);
    }
}
