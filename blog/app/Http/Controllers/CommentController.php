<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comments;

class CommentController extends Controller
{
    /**
     * Insert comment in database
     *
     * @param Request $request
     * @return view and message
     */
    public function store(Request $request)
    {
        //on_post, from_user, body
        $input['from_user'] = $request->user()->id;
        $input['on_post'] = $request->input('on_post');
        $input['body'] = $request->input('body');
        $slug = $request->input('slug');
        Comments::create($input);
        return redirect('/' . $slug)
            ->with([
                'message' => __('custom.message_comment_success'),
                'alert'   => 'alert-success',
            ]);
    }
}
