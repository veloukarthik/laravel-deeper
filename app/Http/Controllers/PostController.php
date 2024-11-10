<?php

namespace App\Http\Controllers;
use App\Models\Posts;
use Illuminate\Http\Request;
use App\Repositories\PostsRepository;
use Illuminate\Support\Facades\Log;
use App\Helpers\Helpers;
use App\Services\CurrencyConverter;
class PostController extends Controller
{

    protected $postsRepository;
    public function __construct(PostsRepository $postsRepository){
        $this->postsRepository = $postsRepository;
    }
    //
    public function index()
    {
        try {
            $posts = $this->postsRepository->getAllPosts();
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

    public function show($id, CurrencyConverter $converter)
    {
        try {


            $result = $converter->convert($id, 'USD', 'INR');
            return $result;
            $post = Posts::find($id);
            // $this->authorize('view', $post);
            Log::info('Posts found');
            if ($post) {

                return response()->json(['message' => 'Post data retrieved successfully.', 'data' => $post], 200);
            } else {
                return response()->json(['message' => 'Post not found'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'body' => 'required|string',
            ]);
            $request['slug'] = Helpers::generateSlug($request->title);
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
                $request['slug'] = Helpers::generateSlug($request->title);
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
