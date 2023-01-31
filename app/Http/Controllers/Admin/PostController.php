<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Post;
use App\Tag;
use App\Mail\SendMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('category', 'tags')->paginate(10);

        return view('admin.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::All();
        $tags = Tag::All();

        return view('admin.post.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();


        //Validazione
        $request->validate([

            'title' => 'required',
            'body' => 'required',
        ]);

        $new_post = new Post();

        if (array_key_exists('image', $data)){

            $cover_url = Storage::put('post_covers', $data['image']);
            $data['cover'] = $cover_url;

        }

        $new_post->fill($data);
        $new_post->save();

        //controllo se l'utente ha cliccato delle checkbox
        if (array_key_exists('tags', $data)) {
            $new_post->tags()->sync($data['tags']);
        }

        $mail = new SendMail($new_post);
        $userEmail = Auth::user()->email;
        Mail::to($userEmail)-> send($mail);
        return redirect()->route('admin.posts.show', $new_post->id);
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
        return view('admin.post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::All();
        $tags = Tag::All();


        return view('admin.post.edit', compact('post', 'categories', 'tags'));
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
        $data = $request->all();
        $post = Post::findOrFail($id);

        $post->update($data);

        // Controlla se l' utente ha cliccato o erano gia selezionate delle checkbox
        if (array_key_exists('tags', $data)) {
            $post->tags()->sync($data['tags']);
        } else {

            //non ci sono checkbox selezionate
            $post->tags()->sync([]);
        }

        return redirect()->route('admin.posts.show', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->tags()->sync([]);
        $post->delete();
        return redirect()->route('admin.posts.index');
    }
}
