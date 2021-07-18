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
        $data = User::find($id);
        if ($data && ($data->id == Auth::user()->id || Auth::user()->is_admin()))
        {
            $user = $data;
            $countPosts = $data->posts->count();
            $countPostsPublished = $data->posts->where('active', 1)->count();
            $countPostsDrafted = $data->posts->where('active', 0)->count();
            $posts = $data->posts
                ->where('active', 1)
                ->sortByDesc('created_at')
                ->take(5);

            return view('user.profile')
                ->with([
                    'count_posts' => $countPosts,
                    'count_posts_published' => $countPostsPublished,
                    'count_posts_drafted' => $countPostsDrafted,
                    'posts' => $posts,
                    'user' => $user,
                ]);
        }

        return redirect('home')
            ->with([
                'message' => __('message_home_fail'),
                'alert' => 'alert-success',
            ]);

    }

    /**
     * Get view my post
     * @return array
     */
    public function getMyPost($id)
    {
        $data = User::find($id);
        if ($data && ($data->id == Auth::user()->id || Auth::user()->is_admin()))
        {
            $user = $data;
            $posts = $data->posts
                ->where('active', 1)
                ->sortByDesc('created_at');

            return view('user.list-posts')
                ->with([
                    'posts' => $posts,
                    'user' => $user,
                ]);
        }

        return redirect('home')
            ->with([
                'message' => __('message_home_fail'),
                'alert' => 'alert-success',
            ]);
    }

    /**
     * Get view my drafts
     * @return array
     */
    public function getMyAllPost($id)
    {
        $data = User::find($id);
        if ($data && ($data->id == Auth::user()->id || Auth::user()->is_admin()))
        {
            $user = $data;
            $posts = $data->posts->sortByDesc('created_at');

            return view('user.list-all-posts')
                ->with([
                    'posts' => $posts,
                    'user' => $user,
                ]);
        }

        return redirect('home')
            ->with([
                'message' => __('message_home_fail'),
                'alert' => 'alert-success',
            ]);
    }

    /**
     * Get view my drafts
     * @return array
     */
    public function geyMyDrafts($id)
    {
        $data = User::find($id);
        if ($data && ($data->id == Auth::user()->id || Auth::user()->is_admin()))
        {
            $user = $data;
            $posts = $data->posts
                ->where('active', 0)
                ->sortByDesc('created_at');

            return view('user.list-drafts')
                ->with([
                    'posts' => $posts,
                    'user' => $user,
                ]);
        }

        return redirect('home')
            ->with([
                'message' => __('message_home_fail'),
                'alert' => 'alert-success',
            ]);
    }

}
