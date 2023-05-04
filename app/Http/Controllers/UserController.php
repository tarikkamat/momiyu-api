<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\RequestCreate;
use App\Http\Requests\User\RequestDestroy;
use App\Http\Requests\User\RequestUpdate;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            return response()->json([
                'success' =>  true,
                'code' => 200,
                'message' => 'Başarılı, kullanıcılar getirildi.',
                'users' => User::all(),
                'roles' => Role::all()
            ], 200);
        }catch (\Exception $e) {
            return response()->json([
                'message' => 'Hata, kullanıcılar getirilemedi.',
                'error' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Create a new user
     *
     * @LRDparam name string|required|max:255
     * @LRDparam email required|email|unique:users,email
     * @LRDparam password required|string|min:6|max:30
     * @LRDparam role string|exists:roles,name
     *
     * @param RequestCreate $request
     * @return JsonResponse
     */
    public function store(RequestCreate $request): JsonResponse
    {
        try {
            $validatedData = $request->validated();
            $user = User::create($validatedData);
            $user->roles()->attach(Role::where('name', $validatedData['role'])->first());
            return response()->json([
                'success' =>  true,
                'code' => 200,
                'message' => 'Başarılı, kullanıcı eklendi.',
                'user' => $user
            ], 200);
        }catch (\Exception $e) {
            return response()->json([
                'message' => 'Hata, kullanıcı eklenemedi.',
                'error' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Update the specified user
     *
     * @LRDparam name string|required|max:255
     * @LRDparam email required|email|unique:users,email
     * @LRDparam password required|string|min:6|max:30
     * @LRDparam role string|exists:roles,name
     *
     * @param RequestUpdate $request
     * @return JsonResponse
     */
    public function update(RequestUpdate $request): JsonResponse
    {
        try {
            $validatedData = $request->validated();

            $user = User::findOrFail($request->id);
            $user->update($validatedData);
            $user->roles()->attach(Role::where('name', $validatedData['role'])->first());

            return response()->json([
                'success' =>  true,
                'code' => 200,
                'message' => 'Başarılı, kullanıcı güncellendi.',
                'user' => $user
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Hata, kullanıcı güncellenemedi.',
                'error' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Delete the specified user
     *
     * @param $id
     * @return JsonResponse
     */
    public function destroy(Request $request): JsonResponse
    {
        try {

            $user = User::findOrFail($request->id);
            $user->delete();

            return response()->json([
                'success' =>  true,
                'code' => 200,
                'message' => 'Başarılı, kullanıcı silindi.',
                'user' => $user
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Hata, kullanıcı silinemedi.',
                'error' => $e->getMessage()
            ], 400);
        }
    }

}
