<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Enums\PostStatus;

class UserController extends Controller
{
    /**
     * Display profile page
     *
     * @param id
     * @return Response
     */
    public function getMyProfile($id)
    {
        $data = User::find($id);
        if ($this->checkData($data)) {
            $user = $data;
            $countPosts = $data->posts->count();
            $countPostsPublished = $data->posts->where('active', PostStatus::Published)->count();
            $countPostsDrafted = $data->posts->where('active', PostStatus::Draft)->count();
            $posts = $data->posts
                ->where('active', PostStatus::Published)
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
     * Display my post page
     *
     * @param id
     * @return Response
     */
    public function getMyPost($id)
    {
        $data = User::find($id);
        if ($this->checkData($data))
        {
            $user = $data;
            $posts = $data->posts
                ->where('active', PostStatus::Published)
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
     * Display all posts page
     *
     * @param id
     * @return Response
     */
    public function getMyAllPosts($id)
    {
        $data = User::find($id);
        if ($this->checkData($data))
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
     * Display my drafts page
     *
     * @param id
     * @return Response
     */
    public function geyMyDrafts($id)
    {
        $data = User::find($id);
        if ($this->checkData($data))
        {
            $user = $data;
            $posts = $data->posts
                ->where('active', PostStatus::Draft)
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

    /**
     * Check user exists, check user = login id, is an admin?
     *
     * @param $user
     * @return bool
     */
    public function checkData($user){
        if($user && ($user->id === Auth::user()->id || Auth::user()->is_admin())){
            return true;
        }
        return false;
    }
}
