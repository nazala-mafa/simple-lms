<?php

namespace Modules\Forum\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Forum\Entities\Feed;

class ForumController extends Controller
{
    public function home()
    {
        $feed = Feed::orderBy('id', 'desc')->take(1)->get()[0];
        return view('forum::forum.index', compact('feed'));
    }
}