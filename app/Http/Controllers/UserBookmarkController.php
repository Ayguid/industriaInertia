<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\UserBookmark;
use Illuminate\Http\Request;
use App\Models\Entity;
use App\Models\User;

class UserBookmarkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        $user = auth()->user();
        $paginate = 8;
        //
        $bookmarks = $user->bookmarks()->withCount([
            'bookmarks',
            'bookmarks as bookmarked' => function ($q) use ($user) {
                $q->where('user_id', $user->id);
            }
        ])->withCasts(['bookmarked' => 'boolean'])->with(['country', 'state', 'city', 'categories'])->paginate($paginate);

        if (request()->input('page') > $bookmarks->lastPage()) { // si el paginator rompe lo mandamos a la ruta inicial
            return redirect()->route('userBookmarks', $user->id);
        };
        //
        return Inertia::render('UserBookmarks', [
            'user_bookmarks' => $bookmarks
        ]);
    }




    public function toggle(Entity $entity)
    {
        $bookmark_limit = 2;
        $entity->bookmarks()->toggle(auth()->id());

        /*
        if (auth()->user()->bookmarks()->count() > $bookmark_limit) { //validamos el limite de bookmarks
            $entity->bookmarks()->toggle(auth()->id());
            return redirect()->back()->withErrors([
                'message' => 'Limit achieved'
            ]);
        }
        */
        return redirect()->back();
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserBookmark  $userBookmark
     * @return \Illuminate\Http\Response
     */
    public function show(UserBookmark $userBookmark)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserBookmark  $userBookmark
     * @return \Illuminate\Http\Response
     */
    public function edit(UserBookmark $userBookmark)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserBookmark  $userBookmark
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserBookmark $userBookmark)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserBookmark  $userBookmark
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserBookmark $userBookmark)
    {
        //
    }
}
