<?php
namespace App\Traits;
use Illuminate\Support\Facades\Log;

trait Logging{
    public function log($message)
    {
        // Log the message to a file or database
        // For example, using Laravel's Log facade:
        Log::info($message);
    }
}