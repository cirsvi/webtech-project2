<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Painting;
use Illuminate\Http\JsonResponse;

class DataController extends Controller
{
    public function getTopPaintings(): JsonResponse
    {
        $paintings = Painting::where('display', true)
            ->inRandomOrder()
            ->take(3)
            ->get()
            ->map(function ($painting) {
            $painting->image = asset('images/' . $painting->image);
            return $painting;
            });
        return response()->json($paintings);
    }

    public function getPainting(Painting $painting): JsonResponse
    {
        $selectedPainting = Painting::where([
            'id' => $painting->id,
            'display' => true,
        ])
            ->firstOrFail();

        $paintingData = [
            'title' => $selectedPainting->title,
            'artist' => $selectedPainting->artist->name,
            'style' => $selectedPainting->style->name,
            'location' => $selectedPainting->location->name,
            'year' => $selectedPainting->year,
            'description' => $selectedPainting->description,
            'image' => asset('images/' . $selectedPainting->image),
        ];

        return response()->json($paintingData);
    }

    public function getRelatedPaintings(Painting $painting): JsonResponse
    {
        $paintings = Painting::where('display', true)
            ->where('id', '<>', $painting->id)
            ->inRandomOrder()
            ->take(3)
            ->get()
            ->map(function ($painting) {
                $painting->image = asset('images/' . $painting->image);
                return $painting;
            });
        return response()->json($paintings);
    }
}
