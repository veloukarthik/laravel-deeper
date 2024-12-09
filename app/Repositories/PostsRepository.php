<?php

namespace App\Repositories;

use App\Services\PostsServices;
use App\Models\Posts;

class PostsRepository
{

    protected $postsServices;

    public function __construct(PostsServices $postsServices)
    {
        $this->postsServices = $postsServices;
    }

    public function getAllPosts()
    {
        try {
            return $this->postsServices->getAllPublishedPosts();
        } catch (\Exception $e) {
            // Log or handle the exception as needed
            return response()->json(['error' => $e->getMessage(),"status"=>400]);
        }

    }
}
