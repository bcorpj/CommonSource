<?php

namespace App\Http\Controllers;

use App\Http\Requests\PositionRequest;
use App\Models\Position;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function interact (PositionRequest $request): JsonResponse
    {
        $data = $request->validated();

        $position = Position::updateOrCreate(['id' => $data['id']], $data);
        return response()->json($position);
    }
}
