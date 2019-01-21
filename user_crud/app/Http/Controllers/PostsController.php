<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use Auth;


class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if(Auth::user()->role == "admin" || Auth::user()->role == "developer") {
            $posts = Post::orderBy('created_at', 'desc')->paginate(8);
        } else {
            $posts = Post::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(8);
        }
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|unique:posts|min:5|max:255',
            'body'  => 'required',
        ]);

        $post = new Post($request->all());
        $post->user_id = Auth::id();
        $post->save();
//        Session::flash('success', 'Your post was successfully created!');
        return redirect()->route('posts.show', [$post->id]);
    }

    public function show($id)
    {
        $post = Post::find($id);

        return view('posts.show', compact('post'));
    }

    public function edit($id)
    {
        $post = Post::find($id);

        if($post->ownedBy(Auth::user()) || Auth::user()->role == "admin" || Auth::user()->role == "developer")
        {
            return view('posts.edit', compact('post'));
        }

        return redirect(route('posts.index'));
    }

    public function update(Request $request, $id)
    {
        $post = Post::find($id);
//
        if($post->ownedBy(Auth::user()) || Auth::user()->role == "admin" || Auth::user()->role == "developer")
        {
            $this->validate($request, [
                'title' => 'required|min:5|max:255',
                'body'  => 'required',
            ]);

            $post->title = $request->title;
            $post->body = $request->body;
            $post->save();


//            //        Session::flash('success', 'Your post was successfully updated.');
            return redirect()->route('posts.show', [$post->id]);
        }

        return redirect(route('posts.index'));
    }


    public function destroy($id)
    {
        $post = Post::find($id);
        if ($post->ownedBy(Auth::user()) || Auth::user()->role == "admin" || Auth::user()->role == "developer") {
            $post->delete();

//          Session::flash('success', 'Your post was successfully deleted.');
            return redirect()->route('posts.index');
        }
    }
}
