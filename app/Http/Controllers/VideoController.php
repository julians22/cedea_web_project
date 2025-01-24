<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Embed\Embed;

class VideoController extends Controller
{
    public function index()
    {
        return view('videos');
    }
}
