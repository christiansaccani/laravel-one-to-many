<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Type;

use App\Http\Requests\StorePostRequest;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::all();

        return view('admin.posts.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        // dd($request);

        // validiamo i nostri parametri
        $request->validated();

        $newPost = new Post();

        // controlliamo se nella request è presente un file in arrivo
        if($request->hasFile('cover_image')) {
            // ci salviamo il percorso dell'immagine in una variabile e contemporaneamente salviamo l'immagine nel server
            // la cartella che abbiamo indicato nel metodo put() se è già presente viene utilizzata, altrimenti viene creata vuota
            $path = Storage::disk('public')->put('post_images', $request->cover_image);
    
            // salvo il nuovo percorso che ho ottenuto dal salvataggio dell'immagine (Laravel per privacy e sicurezza cambia il nome del file)
            $newPost->cover_image = $path;
        }

        $newPost->fill($request->all());
        $newPost->save();

        return redirect()->route('admin.posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $types = Type::all();

        return view('admin.posts.edit', compact('post', 'types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StorePostRequest $request, Post $post)
    {
        $request->validated();

        if($request->hasFile('cover_image')) {
            // ci salviamo il percorso dell'immagine in una variabile e contemporaneamente salviamo l'immagine nel server
            // la cartella che abbiamo indicato nel metodo put() se è già presente viene utilizzata, altrimenti viene creata vuota
            $path = Storage::disk('public')->put('post_images', $request->cover_image);
    
            // salvo il nuovo percorso che ho ottenuto dal salvataggio dell'immagine (Laravel per privacy e sicurezza cambia il nome del file)
            $post->cover_image = $path;
        }

        $post->update($request->all());

        return redirect()->route('admin.posts.show', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('admin.posts.index');
    }
}
