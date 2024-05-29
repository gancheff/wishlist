<?php

namespace App\Http\Controllers\Wishlist;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{
    public function top10php()
    {
        $user = Auth::user();

        $response = Http::get(env('LIBRARIESIO_ENDPOINT') . '/search', [
            'languages' => 'PHP',
            'sort' => 'latest_release_published_at',
            'per_page' => 10,
            'api_key' => $user->api_key,
            'page' => 1,
        ]);

        if ($response->successful()) {
            return response()->json([
                'wishlist' => $user->wishlist,
                'items' => $response->json(),
            ]);
        } else {
            return response()->json([
                'error' => true,
            ], 500);
        }
    }

    public function search()
    {
        $user = Auth::user();

        $response = Http::get(env('LIBRARIESIO_ENDPOINT') . '/search', [
            'languages' => 'PHP',
            'sort' => 'stars',
            'per_page' => 10,
            'api_key' => $user->api_key,
            'page' => request()->get('page'),
            'q' => request()->get('q'),
        ]);

        if ($response->successful()) {
            return response()->json([
                'wishlist' => $user->wishlist,
                'items' => $response->json(),
            ]);
        } else {
            return response()->json([
                'error' => true,
            ], 500);
        }
    }

    public function add()
    {
        $user = Auth::user();

        $response = Http::get(env('LIBRARIESIO_ENDPOINT') . '/' . request()->get('platform') . '/' . urlencode(request()->get('name')), [
            'api_key' => $user->api_key,
        ]);

        if ($response->successful()) {
            $responseJson = $response->json();

            $user->wishlist()->create([
                'item_id' => $responseJson['platform'] . '/' . $responseJson['name'],
                'name' => $responseJson['name'],
                'platform' => $responseJson['platform'],
                'repository_url' => $responseJson['repository_url'],
                'description' => $responseJson['description'],
            ]);
            return response()->json([
                'error' => false,
            ]);
        } else {
            return response()->json([
                'error' => true,
            ], 500);
        }
    }
}
