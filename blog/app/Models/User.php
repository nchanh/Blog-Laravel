<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Notifications\Notifiable;

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
        return $this->hasMany(Comments::class, 'from_user');
    }

    // Checking if a user can post an article or not
    public function can_post()
    {
        $role = $this->role;
        if ($role == 'author' || $role == 'admin') {
            return true;
        }
        return false;
    }

    // Checking if a role is admin or not
    public function is_admin()
    {
        $role = $this->role;
        if ($role == 'admin') {
            return true;
        }
        return false;
    }

    // Checking if a role is author or not
    public function is_author()
    {
        $role = $this->role;
        if ($role == 'author') {
            return true;
        }
        return false;
    }

    // Checking if a role is subscriber or not
    public function is_subscriber()
    {
        $role = $this->role;
        if ($role == 'subscriber') {
            return true;
        }
        return false;
    }
}
