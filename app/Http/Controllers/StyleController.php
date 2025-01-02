<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Style;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class StyleController extends Controller
{
    // display all styles:
    public function list(): View
    {
        $items = Style::orderBy('name', 'asc')->get();
        return view(
            'style.list',
            [
                'title' => 'Styles',
                'items' => $items,
            ]
        );
    }

    // display new style form:
    public function create(): View
    {
        return view(
            'style.form',
            [
                'title' => 'Add new style',
                'style' => new Style(),
            ]
        );
    }

    // create new style:
    public function put(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $style = new Style();
        $style->name = $validatedData['name'];
        $style->save();
        return redirect('/styles');
    }

    // display style editing form
    public function update(Style $style): View
    {
        return view(
            'style.form',
            [
                'title' => 'Edit style',
                'style' => $style
            ]
        );
    }

    // update existing style data:
    public function patch(Style $style, Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $style->name = $validatedData['name'];
        $style->save();
        return redirect('/styles');
    }

    public function delete(Style $style): RedirectResponse
    {
        $style->delete();
        return redirect('/styles');
    }
}
