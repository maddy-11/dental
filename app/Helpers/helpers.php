<?php

use Illuminate\Support\Facades\Http;

if (!function_exists('isUrl404')) {
    function public_path_image($url)
      {
        $response = Http::get(asset($url));
        $url = $response->status() === 404 ? 'public/'.$url : $url;
        return asset($url);
      }
}
