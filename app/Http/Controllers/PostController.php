<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Post;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\posts\CreatePostRequest;
use App\Http\Requests\posts\UpdatePostRequest;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('category.check')->only(['create','store']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Session::forget('hello');
        // dd(session('hello'));
        
        return view('posts.index')->withPosts(Post::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create')->withCategories(Category::all())
        ->withTags(Tag::all())
        ;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest $request)
    {

        $data = $request->all();
        // dd($request->tags);

        // dd($request->file('image'));

        $data['image'] = $request->image->store('posts','public');
        // dd($data);
        $post = Post::create($data);
        if($request->tags)
        {
            $post->tags()->sync($request->tags);
        }
        session()->flash('success','Post Created Successfully');
        return redirect(route('posts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        
        // dd($post->tags->pluck('id')->toArray());
        return view('posts.edit')->withPost($post)->withCategories(Category::all())->withTags(Tag::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $data = $request->all();

        // dd($request->file('image'));
        if($request->hasFile('image'))
        {
            $post->deleteImage();
            $data['image'] = $request->image->store('posts','public');
        }
        $post->update($data);
        $post->tags()->sync($request->tags);
        session()->flash('success','Post Updated Successfully.');
        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($postId)
    {
        $post =  Post::whereId($postId)->first();
        if($post)
        {
            $post->delete();
            session()->flash('success','Post Trashed Successfully');
            return redirect(route('posts.index'));
        }
        else
        {
            return $this->forceDelete($postId);
        }
        
    }

    public function restore($postId)
    {
        $post =  Post::withTrashed()->whereId($postId)->firstOrFail();
        $post->restore();
        session()->flash('success','Post restore Successfully');
        return redirect(route('posts.trash.index'));
    }

    public function forceDelete($postId)
    {
        $post =  Post::withTrashed()->whereId($postId)->firstOrFail();
        $post->forceDelete();
        $post->deleteImage();
        // Storage::delete($post->image);
        session()->flash('success','Post deleted Successfully');
        return redirect(route('posts.trash.index'));
    }

    public function trashIndex()
    {
        return view('posts.trash.index')->withPosts(Post::onlyTrashed()->get());
    }

}
