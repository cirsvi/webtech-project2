<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artist;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;;
use App\Http\Requests\ArtistRequest;

class ArtistController extends Controller
{
    private function saveArtistData(Artist $artist, ArtistRequest $request): void
    {
        $validatedData = $request->validated();

        $artist->fill($validatedData);
        $artist->save();
    }

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
    public function put(ArtistRequest $request): RedirectResponse
    {
        $artist = new Artist();
        $this->saveArtistData($artist, $request);
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
    public function patch(Artist $artist, ArtistRequest $request): RedirectResponse{
        $this->saveArtistData($artist, $request);
        return redirect('/artists');
    }

    // delete
    public function delete(Artist $artist): RedirectResponse{
        $artist->delete();
        return redirect('/artists');
    }
}
