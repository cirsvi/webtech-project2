<?php

namespace App\Http\Controllers;

use App\Models\Style;
use App\Models\Location;
use App\Models\Artist;
use App\Models\Painting;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use App\Http\Requests\PaintingRequest;

class PaintingController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return[
            'auth',
        ];
    }

    private function savePaintingData(Painting $painting, PaintingRequest $request): void
    {
        $validatedData = $request->validated();

        $painting->fill($validatedData);
        $painting->display = (bool) ($validatedData['display'] ?? false);

        if ($request->hasFile('image')) {
            $uploadedFile = $request->file('image');
            $extension = $uploadedFile->clientExtension();
            $name = uniqid();
            $painting->image = $uploadedFile->storePubliclyAs(
                '/',
                $name . '.' . $extension,
                'uploads'
            );
        }

        $painting->save();
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
        $styles = Style::orderBy('name', 'asc')->get();
        $locations = Location::orderBy('name', 'asc')->get();

        return view(
            'painting.form',
            [
                'title' => 'Add new painting',
                'painting' => new Painting(),
                'artists' => $artists,
                'styles' => $styles,
                'locations' => $locations,

            ]
        );
    }

    // Create new Painting entry:
    public function put(PaintingRequest $request): RedirectResponse
    {
        $painting = new Painting();
        $this->savePaintingData($painting, $request);
        return redirect('/paintings');
    }

    public function update(Painting $painting): View
    {
        $artists = Artist::orderBy('name', 'asc')->get();
        $styles = Style::orderBy('name', 'asc')->get();
        $locations = Location::orderBy('name', 'asc')->get();

        return view(
            'painting.form',
            [
                'title' => 'Update painting',
                'painting' => $painting,
                'artists' => $artists,
                'styles' => $styles,
                'locations' => $locations,
            ]
        );
    }

    public function patch(Painting $painting, PaintingRequest $request): RedirectResponse
    {
        $this->savePaintingData($painting, $request);

        session()->flash('success', 'Painting updated successfully!');

        return redirect('/paintings/update/' . $painting->id);
    }

    public function delete(Painting $painting): RedirectResponse
    {
        if ($painting->image) {
            unlink(getcwd() . '/images/' . $painting->image);
        }

        $painting->delete();
        return redirect('/paintings');
    }
}
