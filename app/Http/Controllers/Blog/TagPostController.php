<?php

namespace App\Http\Controllers\Blog;

use App\Tag;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagPostController extends Controller
{
    public function __invoke(Tag $tag)
    {
      return view('blog.tags.post')
      ->withPosts($tag->posts()->searched()->simplePaginate(2))
      ->withTag($tag)
      ->withCategories(Category::all())
      ->withTags(Tag::all());
    }
}
