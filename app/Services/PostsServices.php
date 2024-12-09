<?php

namespace App\Services;
use Exception;
use App\Models\Posts;
class PostsServices{

    public function getAllPublishedPosts() {
        // throw new Exception("This is an exception");
        return Posts::isPublished()->get();
    }
}