<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::where('isPublished', true)->get();
        return view('pages.posts', compact('posts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreatePostRequest $request)
    {
        //$request->validate([
        //     'title' => 'required|string|min:5|max:255',
        //  'body' => 'required|string|min:10|max:5000'
        //]);

        $post = Post::create([
            'title' => $request->title,
            'body' => $request->body
        ]);

        $post->tags()->attach($request->tags);

        return redirect('createpost')->with('status', 'Post successfully created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::findOrFail($id);
        return view('pages.post', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function createPost()
    {
        $tags = Tag::all();
        return view('pages.createpost', compact('tags'));
    }
}
