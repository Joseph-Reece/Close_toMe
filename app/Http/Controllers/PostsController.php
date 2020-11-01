<?php

namespace App\Http\Controllers;

use App\post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;


class PostsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth:web,client');
        // $this->middleware('role:superadministrator|administrator|user');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $post = post::Paginate(3);
        return view('Blog.index')->with('posts', $post);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('Blog.add_post');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'category' => 'required',
            'title' => 'required|string',
            'body' => 'required|string',
            'cover_image' => 'image|nullable|max:6999'
        ]);

        // dd($request->file('cover_image'));

        // Handle file upload

        if ($request->hasFile('cover_image')) {
            # get file name with extenstions
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();

            # get the file name
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            #get the extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();

            # get the filename to store
            $filenameToStore =  $filename . '_' . time() . '.' . $extension;

            #upload image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $filenameToStore);
        } else {
            $filenameToStore = 'no_image.jpg';
        }
        $user = Auth::user();


        $post = new post;

        $post->user_id = $user->id;
        $post->category = $request->input('category');
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->cover_image = $filenameToStore;

        $post->save();

        return redirect('/posts')->with('success', 'Post successful');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(post $post)
    {
        //

        return view('Blog.show_post')->with('posts', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(post $post)
    {
        $user = Auth::user();
        if ($user->owns($post)) {
            # code...
            return view('Blog.edit_post')->with('post', $post);
        }else {
            abort(403);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, post $post)
    {
        //
        $this->validate($request, [
            'category' => 'required',
            'title' => 'required|string',
            'body' => 'required|string',
            'cover_image' => 'image|nullable|max:6999'
        ]);

        // dd($request->file('cover_image'));

        // Handle file upload

        if ($request->hasFile('cover_image')) {
            # get file name with extenstions
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();

            # get the file name
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

            #get the extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();

            # get the filename to store
            $filenameToStore =  $filename . '_' . time() . '.' . $extension;

            #upload image
            $path = $request->file('cover_image')->storeAs('public/cover_images', $filenameToStore);
        } else {
            $filenameToStore = 'no_image.jpg';
        }



        $post->category = $request->input('category');
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        if ($request->hasFile('cover_image')) {
            # code...
            $post->cover_image = $filenameToStore;
        }

        $post->save();

        return redirect('/posts')->with('success', 'Post Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(post $post)
    {
        //
        $user = Auth::user();
        if ($user->owns($post)) {
            # code...
            if ($post->cover_image != 'no_image.jpg') {
                # code...
                Storage::delete('public/cover_images/' . $post->cover_image);
            }
            $post->delete();

            return redirect('/posts')->with('success', 'Post succesfully Deleted!!!');
        }else {
            abort(403);
        }



    }
}
