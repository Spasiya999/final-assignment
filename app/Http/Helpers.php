<?php

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

if (!function_exists('imageCheck')){
    function imageCheck($image){
        // Check if valid URL
        if (str_contains($image, 'http')) {
            return $image;
        } elseif (Storage::disk('public')->exists($image)) {
            return URL::asset('storage/'.$image);
        }else{
            return URL::asset('public/img/placeholder-image.png');
        }
    }
}
