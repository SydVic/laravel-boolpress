<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Tag;
use Illuminate\Http\Request;

class tagController extends Controller
{
    public function show($slug) {
        $tag = Tag::where('slug', '=', $slug)->with(['posts'])->first();

        if ($tag) {
            return response()->json([
                'success' => true,
                'results' => $tag
            ]);
        }
        return response()->json([
            'success' => false,
            'results' => 'no tags found'
        ]);
    }
}
