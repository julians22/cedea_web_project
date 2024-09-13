<?php

namespace App\Http\Controllers;

use App\Models\PostNews;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function create()
    {
        $posts = PostNews::paginate(6);
        return redirect()->route('home');
        // return view('news', compact('posts'));
    }

    public function show()
    {
        // $post = PostNews::findBySlug($slug);
        // return view('news-detail', compact('post'));
        return view('news-detail');
    }
}
