<?php

namespace App\Http\Controllers\API\App;

use App\Http\Controllers\Controller;
use App\Http\Requests\AppRequest\StorePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Image;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Filters\PostFilter;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PostResource::collection(Post::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $user = auth()->user()->id;

        $post = Post::create([
            'title' => $request['title'],
            'description' => $request['description'],
            'published' => $request['published'],
            'user_id' => $user,
        ]);

        foreach ($request->file('images') as $imagefile) {
            $image = new Image;
            $path = $imagefile->store('/images/resource', ['disk' => 'local']);
            $image->image_path = $path;
            $image->post_id = $post->id;
            $image->save();
        }

        return response()->json([
            'Success' => true,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new PostResource(Post::findOrFail($id));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }

    public function search(Request $request)
    {
        $data = $request->validate([
            'title' => '',
            'description' => '',
            'user_id' => 'integer',
            'tag_id' => 'integer',
        ]);

        $filter = app()->make(PostFilter::class, ['queryParams' => array_filter($data)]);

        return PostResource::collection(Post::filter($filter)->paginate(5));
    }
}