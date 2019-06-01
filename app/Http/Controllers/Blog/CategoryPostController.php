<?php

namespace App\Http\Controllers\Blog;

use App\Tag;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryPostController extends Controller
{
    public function __invoke(Category $category)
    {
      return view('blog.categories.post')
      ->withPosts($category->posts()->searched()->simplePaginate(2))
      ->withCategory($category)
      ->withCategories(Category::all())
      ->withTags(Tag::all());
    }
}
