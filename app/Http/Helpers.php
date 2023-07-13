<?php
Namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

if (!function_exists('imageCheck')){
    function imageCheck($image){
        // Check if valid URL
        if (str_contains($image, 'http')) {
            return $image;
        } elseif (Storage::disk('public')->exists($image)) {
            return asset('storage/'.$image);
        }else{
            return asset('public/img/placeholder-image.png');
        }
    }
}
