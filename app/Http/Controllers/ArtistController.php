<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artist;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;;

class ArtistController extends Controller
{
    public function list(): View
    {
        $items = Artist::orderBy('name', 'asc')->get();

        return view(
            'artist.list',
            [
                'title' => 'Artists',
                'items' => $items,
            ]
        );
    }

    // display new Artist form
    public function create(): View{
        return view(
            'artist.form',
            [
                'title' => 'Add new artist',
                'artist' => new Artist()
            ]
        );
    }

    // create new Artist
    public function put(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $artist = new Artist();
        $artist->name = $validatedData['name'];
        $artist->save();

        return redirect('/artists');
    }

    // display Artist editing from
    public function update(Artist $artist): View
    {
        return view(
            'artist.form',
            [
                'title' => 'Edit artist',
                'artist' => $artist,
            ]
        );
    }

    //update existing Artist data
    public function patch(Artist $artist, Request $request): RedirectResponse{
        $validatedData = $request->validate([
           'name' => 'required|string|max:255',
        ]);
        $artist->name = $validatedData['name'];
        $artist->save();

        return redirect('/artists');
    }

    // delete
    public function delete(Artist $artist): RedirectResponse{
        $artist->delete();
        return redirect('/artists');
    }
}
