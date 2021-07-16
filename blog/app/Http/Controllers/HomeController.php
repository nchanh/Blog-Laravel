<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Get view home
     * @return view home
     */
    public function index()
    {
        //fetch 5 posts from database which are active and latest
        $posts = Posts::where('active', 1)->orderBy('created_at','desc')->paginate(5);

        // redirect view home and data posts
        return view('home')->withPosts($posts);
    }

    public function changeLanguage($language)
    {
        \Session::put('website_language', $language);

        return redirect()->back();
    }
}
