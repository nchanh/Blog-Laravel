<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use App\Models\Comments;
use Illuminate\Http\Request;
use \App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{

    /**
     * Get view create Post
     * @return view create Post
     */
    public function create()
    {
        return view('post.create');
    }

    /**
     * Insert post to db
     * @param Request $request
     * @return view create
     */
    public function store(PostRequest $request)
    {
        $post = new Posts();
        $post->title = $request->input('title');
        $post->slug = Str::slug($post->title);

        // check unique title
        $unique = Posts::where('slug', $post->slug)->first();
        if ($unique) {
            return back()->with([
                'message' => __('custom.message_post_unique_error'),
                'alert' => 'alert-success',
            ]);
        }

        $post->body = $request->input('body');
        $post->author_id = $request->user()->id;

        // Check insert or draft
        if ($request->has('save')) {
            $post->active = 0;
            $message = __('custom.message_post_saved_success');
        } else {
            $post->active = 1;
            $message = __('custom.message_post_published_success');
        }

        // Insert Post
        $post->save();

        // Message success
        return redirect()
            ->route('post.create')
            ->with([
                'message' => $message,
                'alert' => 'alert-success',
        ]);
    }

    /**
     * Update Post
     * @param PostRequest $request
     * @return view and message
     */
    public function update(PostRequest $request)
    {
        $post_id = $request->input('post_id');
        $post = Posts::find($post_id);

        // Post exists and author_id post = user_id
        if ($post && ($post->author_id == $request->user()->id || $request->user()->is_admin())) {
            $title = $request->input('title');
            $slug = Str::slug($title);

            // Check unique title
            $unique = Posts::where('slug', $post->slug)->first();
            if ($unique) {
                if ($unique->id != $post_id) {
                    return back()->with([
                        'message' => __('custom.message_post_unique_error'),
                        'alert' => 'alert-danger',
                    ]);
                } else {
                    $post->slug = $slug;
                }
            }

            $post->title = $title;
            $post->body = $request->input('body');

            // Check button action
            if ($request->has('save')) {
                $post->active = 0;
                $message = __('custom.message_post_saved_success');
            } else {
                $post->active = 1;
                $message = __('custom.message_post_update_success');
            }

            // Update Post
            $post->save();

            return redirect()
                ->route('post.edit', ['slug' => $slug])
                ->with([
                    'post' => $post,
                    'message' => $message,
                    'alert' => 'alert-success',
            ]);
        } else {
            return redirect()
                ->route('home')
                ->with([
                    'message' => __('custom.message_home_role_error'),
                    'alert' => 'alert-danger',
                ]);
        }
    }

    /**
     * Show detail Post
     * @param $slug
     * @return view show
     */
    public function show($slug)
    {
        // Check slug exists
        $post = Posts::where('slug', $slug)->first();
        if(!$post)
        {
            return redirect()
                ->route('home')
                ->with([
                    'message' => __('custom.message_home_fail'),
                    'alert' => 'alert-danger',
                ]);
        }
        $comments = Comments::where('on_post', $post->id)->orderBy('created_at','desc')->get();
        return view('post.detail')->withPost($post)->withComments($comments);
    }

    /**
     * Get view edit Post
     * @param Request $request
     * @param $slug
     * @return view
     */
    public function edit(Request $request, $slug)
    {
        $post = Posts::where('slug', $slug)->first();

        // Post exists and author_id post = user_id
        if($post && ($post->author_id === $request->user()->id || $request->user()->is_admin()))
        {
            return view('post.update')->with('post', $post);
        }

        return redirect()
            ->route('home')
            ->with([
                'message' => __('custom.message_home_role_error'),
                'alert' => 'alert-danger',
            ]);
    }

    /**
     * Delete Post
     * @param Request $request
     * @param $id
     * @return view and message
     */
    public function destroy(Request $request, $id)
    {
        // Check author_id = user_id, is admin?
        $post = Posts::find($id);

        // Post exists and author_id post = user_id
        if($post && ($post->author_id == $request->user()->id || $request->user()->is_admin()))
        {
            $post->delete();
            $message = __('custom.message_home_delete_success');
            $alert   = 'alert-success';
        }
        else
        {
            $message = __('custom.message_home_role_error');
            $alert   = 'alert-danger';
        }

        return redirect()
            ->route('home')
            ->with([
                'message' => $message,
                'alert'   => $alert,
            ]);
    }

}
