<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\v1\PostCollection;
use App\Http\Resources\v1\PostResource;
use App\Filters\v1\PostFilter;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //get query items from request
        $filterParams = (new PostFilter())->transform($request);// [[column, operator, value], [column, operator, value]]
       
        $getComents = $request->query('comments');
        if($getComents) $posts = Post::where($filterParams)->with('comments')->paginate();
        else $posts = Post::where($filterParams)->paginate();
        
        return new PostCollection($posts);
        // $posts = Post::where('title', '=', 'Nemo aliquid et sunt quibusdam.')->paginate();
        // return Post::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        return new PostResource(Post::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $getComments = request()->query('comments');
        if($getComments) return new PostResource($post->load('comments'));
        else return  new PostResource($post);
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
