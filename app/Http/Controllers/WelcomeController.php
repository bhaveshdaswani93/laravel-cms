<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Post;
use App\Category;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        return view('welcome')
        ->withCategories(Category::all())
        ->withPosts(Post::searched()->simplePaginate(2))
        ->withTags(Tag::all());
        ;
    }
}
