<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\v1\PostCollection;
use App\Http\Resources\v1\PostResource;
use App\Services\v1\PostQuery;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new PostQuery();
        $queryItems = $filter->transform($request);// [[column, operator, value], [column, operator, value]]

        if($queryItems && count($queryItems) > 0){
            
            $posts = Post::where($queryItems)->paginate();
        }
        else{
            $posts = Post::paginate();
        }

        // $posts = Post::where('title', '=', 'Nemo aliquid et sunt quibusdam.')->paginate();
        
        return new PostCollection($posts);
        // return Post::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return  new PostResource($post);
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
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
