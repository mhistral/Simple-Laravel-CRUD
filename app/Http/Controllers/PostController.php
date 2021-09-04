<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Post $post)
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $user = auth()->user()->id;

        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => $user,
        ]);

        return redirect('/home')->with('toast_success','Added new post!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('/view', ['post' => $post]);

    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $request->validate([
            'search' => 'required'
        ]);

        $user = auth()->user()->id;
        $query = $request->input('search');

        $posts = Post::where(function ($q) use ($query) {
            $q->where('title', 'like', "%$query%")
                ->orWhere('content', 'like', "%$query%");
        })
        ->where(function ($q) use ($user) {
            $q->where('user_id', $user);
        })->get();


        return view('home', ["posts" => $posts]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {

        $user = auth()->user()->id;
        $isValid = Post::where('id',$post->id)->where('user_id', $user)->get();

        if($isValid->isNotEmpty()){
            return view('edit', ['post' => $post]);

        }else{
            return redirect('/home')->with('toast_warning','Invalid Post!');
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $post->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect('/home')->with('toast_success','Post was Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        // return redirect('/home')->with('toast_success','Post was Updated!');
        return "succes";

    }
}
