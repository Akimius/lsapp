<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use DB;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', [
            'except' => ['index', 'show']
        ]);
    }

    public function index()
    {
        // $posts = Post::all();
        // $posts = DB::select('SELECT * FROM posts'); // another way with DB class
        // $posts = Post::orderBy('title', 'desc')->take(1)->get(); // to get only one record
        // $posts = Post::orderBy('title', 'desc')->get();
        $posts = Post::orderBy('updated_at', 'desc')->paginate(10);

        return view('posts.index', [
            'posts' => $posts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:50',
            'body' => 'required|max:150',
            'cover_image' => 'image|nullable|max:1999'
        ]);
        
        // Handle File Upload
        if($request->hasFile('cover_image')){
            // Get file name with the extension
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            
            // Get the extention
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            
            // File name to store
            
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            
            // Upload the image
            $path = $request->file('cover_image')
                ->storeAs('public/cover_images', $fileNameToStore);

        } else {
            
            $fileNameToStore = 'noimage.jpeg';
        }

        $post = new Post();
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
        $post->cover_image = $fileNameToStore;
        $post->save();

        return redirect('/posts')->with('success', 'Post created');
        // Success msg when post is successfully created
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show', [
            'post' => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        // Check for a correct user
        if(auth()->user()->id !== $post->user_id){
            return redirect ('posts')->with('error', 'Unauthorized user');
        }

        return view('posts.edit', [
            'post' => $post
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|max:50',
            'body' => 'required|max:150',
        ]);

        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->body = $request->input('body');
        $post->user_id = auth()->user()->id;
        $post->save();

        return redirect('/posts')->with('success', 'Post updated');
        // Success msg when post is successfully created
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        // Check if the auth user posted the very same ad and can delete it
        if(auth()->user()->id !== $post->user_id){
            return redirect ('posts')->with('error', 'Unauthorized user');
        }

        $post->delete();

        return redirect('/posts')->with('success', 'Post removed');
    }
}
