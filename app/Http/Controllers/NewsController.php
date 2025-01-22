<?php

namespace App\Http\Controllers;

use App\Models\PostNews;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $news = PostNews::paginate(6);
        $banners = PostNews::orderBy('published_at', 'desc')->take(3)->get();

        return view('news', compact(
            'news',
            'banners'
        ));
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show(PostNews $post)
    {
        return view('news.show', compact('post'));
    }
}
