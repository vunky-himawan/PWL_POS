<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserModel;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            $users = UserModel::all();

            return response()->json([
                'code' => 201,
                'message' => 'Success',
                'data' => $users
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'code' => 500,
                'message' => $th->getMessage()
            ]);
        }
    }

    public function store(Request $request): JsonResponse
    {

        try {
            $validator = Validator::make($request->all(), [
                'username' => 'required|unique:m_user,username',
                'name' => 'required',
                'password' => 'required|min:8',
                'level_id' => 'required'
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $request['password'] = Hash::make($request->password);

            $user = UserModel::create($request->all());

            return response()->json([
                'code' => 200,
                'message' => 'Success',
                'data' => $user
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'code' => 500,
                'message' => $th->getMessage()
            ]);
        }
    }

    public function show(string $user_id): JsonResponse
    {
        try {
            $user = UserModel::findOrFail($user_id);

            return response()->json([
                'code' => 200,
                'message' => 'Success',
                'data' => $user
            ]);
        } catch (ModelNotFoundException) {
            return response()->json([
                'code' => 404,
                'message' => "Data Tidak Ditemukan"
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'code' => 500,
                'message' => $th->getMessage()
            ]);
        }
    }

    public function update(Request $request, string $user_id): JsonResponse
    {
        try {
            $user = UserModel::findOrFail($user_id);

            $user->update($request->all());

            return response()->json([
                'code' => 200,
                'message' => "Data Berhasil",
                'data' => $user
            ]);
        } catch (ModelNotFoundException) {
            return response()->json([
                'code' => 404,
                'message' => "Data Tidak Ditemukan"
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'code' => 500,
                'message' => $th->getMessage()
            ]);
        }
    }

    public function destroy(string $user_id): JsonResponse
    {
        try {
            $user = UserModel::findOrFail($user_id);

            $user->delete();

            return response()->json([
                'code' => 200,
                'message' => "Data Terhapus"
            ]);

        } catch (ModelNotFoundException) {
            return response()->json([
                'code' => 404,
                'message' => "Data Tidak Ditemukan"
            ], 404);
        } catch (\Throwable $th) {
            return response()->json([
                'code' => 500,
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
