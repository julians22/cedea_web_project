<?php

namespace App\Http\Controllers;

use App\Models\PostNews;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function create()
    {
        $news = PostNews::paginate(6);
        $banners = $news->take(3);

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
        return view('news-detail', compact('post'));
    }
}
