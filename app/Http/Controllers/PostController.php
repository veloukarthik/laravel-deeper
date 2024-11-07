<?php

namespace App\Http\Controllers;
use App\Models\Posts;
use Illuminate\Http\Request;
use Elasticsearch\Client;

class PostController extends Controller
{
    //
    public function index()
    {
        try {
            $posts = Posts::IsPublished()->get();
            return response()->json(data: ['message' => 'Post data retrieved successfully.', 'data' => $posts], status: 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function indexPost(Posts $post)
    {
        app('Elasticsearch')->index([
            'index' => 'posts',
            'id' => $post->id,
            'body' => $post->toSearchArray(),
        ]);
    }

    public function show($id)
    {
        try {
            $post = Posts::find($id);
            $this->authorize('view', $post);
            if ($post) {
                $this->indexPost($post);

                // Search posts
                $results = $this->searchPosts('your search query');
                return response()->json(['message' => 'Post data retrieved successfully.', 'data' => $post, "result" => $results], 200);
            } else {
                return response()->json(['message' => 'Post not found'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function searchPosts($query)
    {
        $response = app('Elasticsearch')->search([
            'index' => 'posts',
            'body' => [
                'query' => [
                    'multi_match' => [
                        'query' => $query,
                        'fields' => ['title', 'content'],
                    ]
                ]
            ]
        ]);

        $posts = collect($response['hits']['hits'])->map(function ($hit) {
            return $hit['_source'];
        });

        return $posts;
    }


    public function store(Request $request)
    {
        try {
            $post = Posts::create($request->all());
            return response()->json(['message' => 'Post created successfully.', 'data' => $post], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $post = Posts::find($id);
            if ($post) {
                $post->update($request->all());
                return response()->json(['message' => 'Post updated successfully.', 'data' => $post], 200);
            } else {
                return response()->json(['message' => 'Post not found'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $post = Posts::find($id);
            if ($post) {
                $post->delete();
                return response()->json(['message' => 'Post deleted successfully.'], 200);
            } else {
                return response()->json(['message' => 'Post not found'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
