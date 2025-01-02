<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class LocationController extends Controller
{
    // display all locations:
    public function list(): View
    {
        $items = Location::orderBy('name', 'asc')->get();
        return view(
            'location.list',
            [
                'title' => 'Locations',
                'items' => $items,
            ]
        );
    }

    // display new location form:
    public function create(): View
    {
        return view(
            'location.form',
            [
                'title' => 'Add new location',
                'location' => new Location(),
            ]
        );
    }

    // create new location:
    public function put(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $location = new Location();
        $location->name = $validatedData['name'];
        $location->save();
        return redirect('/locations');
    }

    // display location editing form
    public function update(Location $location): View
    {
        return view(
            'location.form',
            [
                'title' => 'Edit location',
                'location' => $location,
            ]
        );
    }

    // update existing location data:
    public function patch(Location $location, Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $location->name = $validatedData['name'];
        $location->save();
        return redirect('/locations');
    }

    public function delete(Location $location): RedirectResponse
    {
        $location->delete();
        return redirect('/locations');
    }
}
