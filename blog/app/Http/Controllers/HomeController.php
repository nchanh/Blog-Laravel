<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use App\Enums\PostStatus;

class HomeController extends Controller
{
    /**
     * Display home page.
     *
     * @return Response
     */
    public function index()
    {
        //fetch 5 posts from database which are active and latest
        $posts = Posts::where('active', PostStatus::Published)->orderBy('created_at','desc')->paginate(5);

        return view('home')->withPosts($posts);
    }

    public function changeLanguage($language)
    {
        \Session::put('website_language', $language);

        return redirect()->back();
    }
}
