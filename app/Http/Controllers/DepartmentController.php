<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepartmentRequest;
use App\Models\Department;
use Illuminate\Http\JsonResponse;

class DepartmentController extends Controller
{

    public function create (DepartmentRequest $request): JsonResponse
    {
        return response()->json([
            'message' => 'New Department created successfully',
            'department' => Department::create( $request->validated() )
        ]);
    }
}
