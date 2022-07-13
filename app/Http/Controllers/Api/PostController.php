<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request) {
        $items_per_page = $request->items_per_page ? $request->items_per_page : 9;
        // richiesta al server dei dati
        // $posts = Post::all();
        $posts = Post::paginate($items_per_page);

        // conversione dei dati in Json per poterli passare a Vue
        // response() ti ritorna la risposta http
        return response()->json([
            // se non va a buon fine non ti arriva true
            'success' => true,
            'results' => $posts
        ]);
    }
}