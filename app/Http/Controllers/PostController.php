<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Post;

class PostController extends Controller
{
    public function index() {
        $posts = Post::orderBy('created_at','desc')->simplePaginate(6);
        dd($posts);
    	return view('post/index',compact('posts'));
    }

    public function create() {

    }

    public function store() {

    }

    public function edit() {

    }
    public function update() {

    }

    public function delete() {

    }
}
