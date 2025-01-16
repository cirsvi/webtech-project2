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
            ->take(5)
            ->get();

        return response()->json($paintings);
    }

    public function getPainting(Painting $painting): JsonResponse
    {
        logger()->info('Fetching painting:', ['id' => $painting->id]);

        $selectedPainting = Painting::where([
            'id' => $painting->id,
            'display' => true,
        ])
        ->firstOrFail();

        return response()->json($selectedPainting);
    }

    public function getRelatedPaintings(Painting $painting): JsonResponse
    {
        $paintings = Painting::where('display', true)
            ->where('id', '<>', $painting->id)
            ->inRandomOrder()
            ->take(3)
            ->get();

        return response()->json($paintings);
    }
}
