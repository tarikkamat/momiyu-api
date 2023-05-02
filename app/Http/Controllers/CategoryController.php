<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\RequestCreate;
use App\Http\Requests\Category\RequestUpdate;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Get all categories
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $categories = Category::all();
            return response()->json($categories);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Hata, kategoriler getirilemedi.',
                'error' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Create a new category
     *
     * @param RequestCreate $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function store(RequestCreate $request): JsonResponse
    {
        $validatedData = $request->validated();

        try {
            $category = Category::create($validatedData);
            return response()->json([
                'message' => 'Başarılı, kategori oluşturuldu.',
                'category' => $category
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Hata, kategori oluşturulamadı.',
                'error' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Update an existing category
     *
     * @param RequestUpdate $request
     * @param Category $category
     * @return JsonResponse
     * @throws ValidationException
     */
    public function update(RequestUpdate $request): JsonResponse
    {
        $validatedData = $request->validated();

        try {
            $category = Category::firstWhere('id', $request->id);
            $category->update($validatedData);

            return response()->json([
                'message' => 'Başarılı, kategori güncellendi.',
                'category' => $category
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Hata, kategori güncellenemedi.',
                'error' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Delete an existing category
     *
     * @param Category $category
     * @return JsonResponse
     */
    public function destroy(Request $request): JsonResponse
    {
        try {
            $category = Category::find($request->id);
            $category->delete();
            return response()->json([
                'message' => 'Başarılı, kategori silindi.'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Hata, kategori silinemedi.',
                'error' => $e->getMessage()
            ], 400);
        }
    }
}
