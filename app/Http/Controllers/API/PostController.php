<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function getAllPost()
    {
        try {
            $posts = Post::all();
            return response()->json([
                'status' => '200',
                'message' => 'Get all post successfully',
                'body' => $posts,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => '400',
                'message' => $th,
            ], 400);
        }
    }
    public function getDetailPost($post_id)
    {
        try {
            $post = Post::findOrFail($post_id);
            return response()->json([
                'status' => '200',
                'message' => 'Get data successfully',
                'body' => $post,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => '400',
                'message' => $th,
            ], 400);
        }
    }
    public function createPost(Request $request)
    {
        try {
            $request->validate([
                'mitra_id' => 'required',
                'title' => 'required',
                'content' => 'required',
            ]);
            $post = new Post;
            $post->mitra_id = $request->mitra_id;
            $post->title = $request->title;
            $post->content = $request->content;
            $post->save();
            return response()->json([
                'status' => '200',
                'message' => 'Post created successfully',
                'body' => $post,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => '400',
                'message' => $th,
            ], 400);
        }
    }
}
