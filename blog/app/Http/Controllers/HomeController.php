<?php

namespace App\Http\Controllers;

use App\Models\Posts;

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
        $posts = Posts::where('active', 1)->orderBy('created_at','desc')->paginate(5);

        return view('home')->withPosts($posts);
    }

    public function changeLanguage($language)
    {
        \Session::put('website_language', $language);

        return redirect()->back();
    }
}
