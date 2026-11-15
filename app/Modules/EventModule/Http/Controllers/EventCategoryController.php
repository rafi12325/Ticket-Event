<?php

namespace App\Modules\EventModule\Http\Controllers;

use App\Modules\EventModule\Http\Requests\StoreCategoryRequest;
use App\Modules\EventModule\Models\EventCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class EventCategoryController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(['data' => EventCategory::query()->orderBy('name')->get()]);
    }

    public function store(StoreCategoryRequest $request): JsonResponse
    {
        return response()->json(['data' => EventCategory::create($request->validated())], 201);
    }

    public function destroy(EventCategory $category): JsonResponse
    {
        $category->delete();

        return response()->json(['message' => 'Kategori berhasil dihapus.'], 200);
    }
}
