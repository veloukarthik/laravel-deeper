<?php
namespace App\Helpers;
use Str;
class Helpers{

    public static function generateRandomString($length = 10) {
        
        return Str::random($length);
    }

    public static function generateUniqueId($length = 10) {
        
        return Str::orderedUuid()->toString();
    }

    public static function currency($number)
    {
        return number_format($number, 2);
    }

    public static function generateSlug($slug) {

        return Str::slug($slug);
    }
}
