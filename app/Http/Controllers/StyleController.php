<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Style;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StyleRequest;

class StyleController extends Controller
{
    private function saveStyleData(Style $style, StyleRequest $request): void
    {
        $validatedData = $request->validated();
        $style->fill($validatedData);
        $style->save();
    }

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
    public function put(StyleRequest $request): RedirectResponse
    {
        $style = new Style();
        $this->saveStyleData($style, $request);
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
    public function patch(Style $style, StyleRequest $request): RedirectResponse
    {
        $this->saveStyleData($style, $request);
        return redirect('/styles');
    }

    public function delete(Style $style): RedirectResponse
    {
        $style->delete();
        return redirect('/styles');
    }
}
