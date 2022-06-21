<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Entity;
use App\Models\Media;
use Illuminate\Http\Request;
use DB;
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Mejorar ESTO!!!! esta chancho
        $validatedData = $request->validate([
            //'title' => 'required|string|min:4',
            'content' => 'required|string|min:4',
        ]);
        $entity_id = $request['entity_id'];
        $model_type = null;
        //check if entity belongs to user, si es asi entity
        if ($entity_id && $request->user()->entities()->find($entity_id)) { //es para un entity
            $model_type = Entity::class;
        } else { //sino, es para un user
            $entity_id = null;
            $model_type = User::class;
        }
        //
        return DB::transaction(function () use ($request, $validatedData, $entity_id, $model_type) {
            $post = Post::create([
                'model_id' => $entity_id ?? null,
                'model_type' => $model_type,
                'user_id' => $request->user()->id,
                'title' => "null",
                'content' => $validatedData['content']
            ]);
            //uploadImages

            if (count($request->files->all()) > 0) { //
                $media = $request->file('media');
                foreach ($media as $key => $image) {
                    $image->store('media/' . $request->user()->id . '/' . now()->format('Y') . '/' . now()->format('m'), 'public');
                    //--//--//
                    $media = Media::create([
                        'model_id' => $post->id,
                        'model_type' => Post::class,
                        'filename' => $image->hashName(),
                        'mime_type' => $image->getMimeType(),
                        'size' => $image->getSize(),
                        'user_id' => $request->user()->id
                    ]);
                }
            }

            //truco porque si devolvemos $post no appendea las relations del $with del modelo
            return redirect()->back();
        });
        //como primero se suben las imagenes, despues se hace update de sus ṕostid una vez creado el post
        /*
        Media::find($request->mediaIds)->each->update([
            'model_id' => $post->id,
            'model_type' => Post::class
        ]);
        */
        //return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        return DB::transaction(function () use ($post) {
            $post->media()->each(function ($med) {
                $location = 'media/' . $med->user_id . '/' . date_format($med->created_at, 'Y') . '/' . date_format($med->created_at, 'm') . '/' . $med->filename;
                Storage::disk('public')
                    ->delete($location);
                $med->delete();
            });
            //$post->media()->delete();

            if ($post->delete()) {
                //return response("Deleted", 200);
                return redirect()->back();
            }
        });
        //return redirect()->back();
    }
}
