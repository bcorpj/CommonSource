<?php

namespace App\Http\Controllers;

use App\Custom\Additional\Arrays;
use App\Http\Requests\PositionRequest;
use App\Models\Position;
use Illuminate\Http\JsonResponse;

class PositionController extends Controller
{
    public function interact (PositionRequest $request): JsonResponse
    {
        $data = $request->validated();
        $position = Position::updateOrCreate(Arrays::is_item('id', $data), $data);
        return response()->json($position);
    }
}
