<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Comments;

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
        if ($data && ($data->id == Auth::user()->id || Auth::user()->is_admin())) {
            $user = $data;
            $countPosts = $data->posts->count();
            $countPostsPublished = $data->posts->where('active', 1)->count();
            $countPostsDrafted = $data->posts->where('active', 0)->count();
            $posts = $data->posts
                ->where('active', 1)
                ->sortByDesc('created_at')
                ->take(5);

            $countComments = Comments::with('author')->where('from_user' , $id)->count();
            $comments = Comments::with('author')
                ->where('from_user' , $id)
                ->orderBy('created_at','desc')
                ->limit(5)
                ->get();

            return view('user.profile')
                ->with([
                    'count_posts' => $countPosts,
                    'count_posts_published' => $countPostsPublished,
                    'count_posts_drafted' => $countPostsDrafted,
                    'count_comments' => $countComments,
                    'posts' => $posts,
                    'user' => $user,
                    'comments' => $comments,
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
     * Display all posts page
     *
     * @param id
     * @return Response
     */
    public function getMyAllPosts($id)
    {
        $data = User::find($id);
        if ($data && ($data->id === Auth::user()->id || Auth::user()->is_admin()))
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
