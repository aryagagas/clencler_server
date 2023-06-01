<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function getAllPosts()
    {
        try {
            $posts = Post::all();
            return response()->json(['body'=>$posts]);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th]);
        }
    }
    public function getPost($postid)
    {
        try {
            $post = Post::findOrFail($postid);
            return response()->json(['body'=>$post]);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th]);
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
            return response()->json(['message' => 'Post berhasil dibuat']);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th]);
        }
    }
}
