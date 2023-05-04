<?php

namespace App\Http\Controllers;

use App\Http\Requests\Role\RequestCreate;
use App\Http\Requests\Role\RequestUpdate;
use App\Models\Role;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $roles = Role::all();
            return response()->json([
                'success' => true,
                'code' => 200,
                'message' => 'Başarılı, roller getirildi.',
                'roles' => $roles
            ], 200);
        }catch (Exception $e) {
            return response()->json([
                'message' => 'Hata, roller getirilemedi.',
                'error' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(RequestCreate $request): JsonResponse
    {
        try {
            $validatedData = $request->validated();
            $role = Role::create($validatedData);
            return response()->json([
                'success' => true,
                'code' => 200,
                'message' => 'Başarılı, rol oluşturuldu.',
                'role' => $role
            ], 200);
        }catch (Exception $e) {
            return response()->json([
                'message' => 'Hata, rol oluşturulamadı.',
                'error' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * @param Request $request
     * @param Role $role
     * @return JsonResponse
     */
    public function update(RequestUpdate $request): JsonResponse
    {
        try {
            $validatedData = $request->validated();
            $role = Role::findOrFail($request->id);
            $role->update($validatedData);
            return response()->json([
                'success' => true,
                'code' => 200,
                'message' => 'Başarılı, rol güncellendi.',
                'role' => $role
            ], 200);
        }catch (Exception $e) {
            return response()->json([
                'message' => 'Hata, rol güncellenemedi.',
                'error' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function destroy(Request $request): JsonResponse
    {
        try {
            $role = Role::findOrFail($request->id);
            $role->delete();
            return response()->json([
                'success' => true,
                'code' => 200,
                'message' => 'Başarılı, rol silindi.',
                'role' => $role
            ], 200);
        }catch (Exception $e) {
            return response()->json([
                'message' => 'Hata, rol silinemedi.',
                'error' => $e->getMessage()
            ], 400);
        }
    }
}
