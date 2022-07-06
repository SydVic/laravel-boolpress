<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // controllo dei dati
        $request->validate($this->getValidationRules());

        // salvataggio dei dati nel database
        $data = $request->all();
        $new_post = new Post();
        $new_post->fill($data);
        $new_post->slug = $this->generateUniqueSlug($new_post->title);
        $new_post->save();

        return redirect()->route('admin.posts.show', ['post' => $new_post->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);

        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post_to_edit = Post::findOrFail($id);

        return view('admin.posts.edit', compact('post_to_edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // controllo dei dati
        $request->validate($this->getValidationRules());

        // salvataggio dati
        $data = $request->all();
        $post_to_update = Post::findOrFail($id);
        $post_to_update->fill($data);
        $post_to_update->slug = $this->generateUniqueSlug($post_to_update->title);
        
        $post_to_update->save();
        return redirect()->route('admin.posts.show', ['post' => $post_to_update->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    /**
     * getValidationRules
     *
     * @return an array with the validation rules for the form
     */
    private function getValidationRules() {
        return [
            'title' => 'required|max:255',
            'content' => 'required|max:20000'
        ];
    }
    
    /**
     * createUniqueSlug
     *
     * @return unique slug string
     */
    private function generateUniqueSlug($title) {
        $base_slug = Str::slug($title, '-');
        $slug = $base_slug;
        $count = 1;
        $slug_found = Post::where('slug', '=', $slug)->first();
        while($slug_found) {
            $slug = $base_slug . '-' . $count;
            $slug_found = Post::where('slug', '=', $slug)->first();
            $count++;
        }
        return $slug;
    }
}
