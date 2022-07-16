<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate(6);

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.posts.create', compact('categories', 'tags'));
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

        // controllo se l'immagine viene caricata, se c'è faccio storage e  creo il path altrimenti no
        if(isset($data['image'])) {
            $image_path = Storage::put('post_covers', $data['image']);
            $data['cover'] = $image_path;
        }

        $new_post = new Post();
        $new_post->fill($data);
        $new_post->slug = Post::generateUniqueSlug($new_post->title);
        $new_post->save();

        // salvataggio dei tags del post dopo save perchè ci serve che venga creato prima l'id del post
        if (isset($data['tags'])) {
            $new_post->tags()->sync($data['tags']);
        }

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
        $category = $post->category;
        $tags= $post->tags;

        return view('admin.posts.show', compact('post', 'category', 'tags'));
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
        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.posts.edit', compact('post_to_edit', 'categories', 'tags'));
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

        // salvataggio dati con metodo save
        // $data = $request->all();
        // $post_to_update = Post::findOrFail($id);
        // $post_to_update->fill($data);
        // $post_to_update->slug = Post::generateUniqueSlug($post_to_update->title);
        // $post_to_update->save();

        // salvataggio dati con metodo update
        $data = $request->all();
        $post_to_update = Post::findOrFail($id);

        // se abbiamo cambiato l'immagine e quindi in $data è presente image
        if(isset($data['image'])) {
            // cancelliamo l'immagine precedente
            if( $post_to_update->cover) {
                Storage::delete($post_to_update->cover);
            }
            // salviamo l'immagine nuova
            $image_path = Storage::put('post_covers', $data['image']);
            $data['cover'] = $image_path;
        }

        $data['slug'] = Post::generateUniqueSlug($data['title']);
        $post_to_update->update($data);

        if (isset($data['tags'])) {
            $post_to_update->tags()->sync($data['tags']);
        } else {
            $post_to_update->tags()->sync([]);
        }

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
        $post_to_destroy = Post::findOrFail($id);
        // per eliminare prima i record dalla tabella ponte, potrebbe servire con alcune restrizioni del database
        // $post_to_destroy->tags()->sync([]);

        // se c'è l'immagine di copertina la cancelliamo
        if($post_to_destroy->cover) {
            Storage::delete($post_to_destroy->cover);
        }
        $post_to_destroy->delete();

        return redirect()->route('admin.posts.index');
    }
    
    /**
     * getValidationRules
     *
     * @return an array with the validation rules for the form
     */
    private function getValidationRules() {
        return [
            // devi usare i name che hai usato nella form
            'title' => 'required|max:255',
            // con image crea problemi
            'image' => 'mimes:jpeg,png,jpg|max:512',
            // 'image' => 'image|max:512',
            'content' => 'required|max:20000',
            // puo essere null e poi deve esistere nella tabella->categories nella colonna->id
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|exists:tags,id'
        ];
    }
}
