<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Models\Painting;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;

class PaintingController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return[
            'auth',
        ];
    }

    public function list(): View
    {
        $items = Painting::orderBy('title', 'asc')->get();

        return view(
            'painting.list',
            [
                'title'=> 'Paintings',
                'items' => $items
            ]
        );
    }

    public function create(): View
    {
        $artists = Artist::orderBy('name', 'asc')->get();

        return view(
            'painting.form',
            [
                'title' => 'Add new painting',
                'painting' => new Painting(),
                'artists' => $artists,
            ]
        );
    }

    // Create new Painting entry:
    public function put(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'title' => 'required|min:3|max:256',
            'artist_id' => 'required',
            'description' => 'nullable',
            'year' => 'numeric',
            'image' => 'nullable|image',
            'display' => 'nullable',
        ]);

        $painting = new Painting();
        $painting->title = $validatedData['title'];
        $painting->artist_id = $validatedData['artist_id'];
        $painting->description = $validatedData['description'];
        $painting->year = $validatedData['year'];
        $painting->display = (bool) ($validatedData['display'] ?? false);
        $painting->save();

        return redirect('/paintings');
    }

    public function update(Painting $painting): View
    {
        $artists = Artist::orderBy('name', 'asc')->get();

        return view(
            'painting.form',
            [
                'title' => 'Update painting',
                'painting' => $painting,
                'artists' => $artists,
            ]
        );
    }

    public function patch(Painting $painting, Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'title' => 'required|min:3|max:256',
            'artist_id' => 'required',
            'description' => 'nullable',
            'year' => 'numeric',
            'image' => 'nullable|image',
            'display' => 'nullable',
        ]);

        $painting->title = $validatedData['title'];
        $painting->artist_id = $validatedData['artist_id'];
        $painting->description = $validatedData['description'];
        $painting->year = $validatedData['year'];
        $painting->display = (bool) ($validatedData['display'] ?? false);
        $painting->save();

        // Different from the code provided in project description:
        return redirect('/paintings');
    }

    public function delete(Painting $painting): RedirectResponse
    {
        $painting->delete();
        return redirect('/paintings');
    }
}
