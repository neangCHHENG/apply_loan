<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class InstagramController extends Controller
{
    public function fetchPosts()
    {
        $accessToken = 'IGQVJWRnF4S1dRUjBxUi02Vk05c3Rya2VSX2ZAjQk1DVlNFYkhXSnRKQmxFYk5NLUhOelFxXzZAEcG96N2pobVdpcmlpUWJTT256STdYbWNkTjRWME41dkgyUHJ1SGVqS2YxM2JaWjJoMmNNTm1HRl9UTwZDZD'; // Replace with your access token

        try {
            $response = Http::get("https://graph.instagram.com/me/media?fields=id,media_type,media_url,thumbnail_url,caption&access_token={$accessToken}");

            $data = $response->json();

            $posts = $data['data']; // Fetch the posts data
            dd($posts);
            return view('Cms.home', compact('posts'));
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
