<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Requests\v1\StorePostRequest;
use App\Http\Requests\v1\UpdatePostRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\v1\PostCollection;
use App\Http\Resources\v1\PostResource;
use App\Filters\v1\PostFilter;
use App\Http\Requests\v1\BulkStorePostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

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
     * Undocumented function
     *
     * @param Post $post
     * @return void
     */
    public function bulkStore(BulkStorePostRequest $request){
        //renombrar userId because we made a user_id
        $bulk = collect($request->all())->map(function($arr, $key){
            return Arr::except($arr, ['userId']);
        }); 
        $posts = [];
        foreach ($bulk as $post_data) {
            $post = new Post($post_data);
            $post->save();
            $posts[] = $post;
        }
        
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
        $post->update($request->all());
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
