<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    /**
     * Get view profile
     * @return array
     */
    public function getMyProfile($id)
    {
        $user = User::where('id', $id)->get();
        $countPosts = Posts::with('author')->where('author_id', $id)->count();
        $countPostsPublished = Posts::with('author')->where(['author_id' => $id, 'active' => 1])->count();
        $countPostsDrafted = Posts::with('author')->where(['author_id' => $id, 'active' => 0])->count();
        $posts = Posts::with('author')
            ->where('author_id', $id)
            ->orderBy('created_at','desc')
            ->paginate(3);


        return view('user.profile')
            ->with([
                'count_posts' => $countPosts,
                'count_posts_published' => $countPostsPublished,
                'count_posts_drafted' => $countPostsDrafted,
                'posts' => $posts,
                'user' => $user,
            ]);
    }

    /**
     * Get view my post
     * @return array
     */
    public function getMyPost($id)
    {
        $user = User::where('id', $id)->get();
        $posts = Posts::with('author')
            ->where(['author_id' => $id, 'active' => 1])
            ->orderBy('created_at','desc')
            ->get();

        return view('user.list-posts')
            ->with([
                'posts' => $posts,
                'user' => $user,
            ]);
    }

    /**
     * Get view my drafts
     * @return array
     */
    public function getMyAllPost($id)
    {
        $user = User::where('id', $id)->get();
        $posts = Posts::with('author')
            ->where('author_id', $id)
            ->orderBy('created_at','desc')
            ->get();

        return view('user.list-all-posts')
            ->with([
                'posts' => $posts,
                'user' => $user,
            ]);
    }

    /**
     * Get view my drafts
     * @return array
     */
    public function geyMyDrafts($id)
    {
        $user = User::where('id', $id)->get();
        $posts = Posts::with('author')
            ->where(['author_id' => $id, 'active' => 0])
            ->orderBy('created_at','desc')
            ->get();

        return view('user.list-drafts')
            ->with([
                'posts' => $posts,
                'user' => $user,
            ]);
    }

}