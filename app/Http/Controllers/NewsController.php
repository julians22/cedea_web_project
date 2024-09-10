<?php

namespace App\Http\Controllers;

use App\Models\PostNews;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $posts = PostNews::paginate(6);
        return view('news', compact('posts'));
    }

    public function show($slug)
    {
        $post = PostNews::findBySlug($slug);
        return view('news-detail', compact('post'));
    }
}