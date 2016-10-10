<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Controllers\Controller;

use App\Post; // new object;
use Session;

class PostController extends Controller
{

     public function __construct()
     {
         $this->middleware('auth');
     }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //create a variable and store all blog posts in it from the database
        //$posts = Post::all();
        // $post = Post::paginate(4);
       // $posts = Post::orderBy('id', 'asc')->paginate(5);
        $posts = Post::orderBy('id', 'desc')->paginate(5);



        //return a view and pass in the above variable
        return view('posts.index')->withPosts($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        // validate the data
         $this->validate($request, array(
             'title' =>'required|max:255',
             'body' => 'required',
             'slug' => 'required|alpha_dash|min:5|max:255',
         ));

        // store in database
        $post = new Post;

        $post->title = $request->title;
        $post->body = $request->body;
        $post->slug = $request->slug;


        $post->save();

        Session::flash('success','The blog was successfully saved!');

        // redirect to another page

        return redirect()->route('posts.show',$post->id);
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
        return view('posts.show')->withPost($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //find the post in database and save as variable

         $post = Post::find($id);

        // return th view and pass in the variable we previously created

        return view('posts.edit')->withPost($post);
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
        //validate the data before use it.

            $post = Post::find($id);

         if($request->input('slug') == $post->slug) {
             $this->validate($request, array(
                 'title' =>'required|max:255',
                 'body' => 'required'
             ));

         } else {
                    $this->validate($request, array(
                         'title' =>'required|max:255',
                         'body' => 'required',
                         'slug' => 'required|alpha_dash|min:5|max:255|unique:posts,slug',
                     ));
         }

        // save the data to the database

         $post = Post::find($id);

         $post->title = $request->input('title');
         $post->body  = $request->input('body');
         $post->slug  = $request->input('slug');

          $post->save();

        // set flash data with success message

        Session::flash('success','This post was successfuly saved.');

        // redirect with flash data to posts.show

        return redirect()->route('posts.show',$post->id);


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

        $post->delete();

        Session::flash('success','The post was successfully deleted.');

        return redirect()->route('posts.index');
    }
}
