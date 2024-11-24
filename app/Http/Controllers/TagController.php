<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function __invoke()
    {
        $tags = Tag::where('name', 'like', '%' . request('q') . '%')->get();
        return view('results', ['jobs' => $tags]);
    }
}
