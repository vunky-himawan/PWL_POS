<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\KategoriModel;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KategoriController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            $categories = KategoriModel::all();

            return response()->json([
                'code' => 200,
                'message' => 'Success',
                'data' => $categories
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
                'kategori_kode' => 'required',
                'kategori_nama' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $category = KategoriModel::create($request->all());

            return response()->json([
                'code' => 201,
                'message' => 'Success',
                'data' => $category
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'code' => 500,
                'message' => $th->getMessage()
            ]);
        }
    }

    public function show(string $category_id): JsonResponse
    {
        try {
            $category = KategoriModel::findOrFail($category_id);

            return response()->json([
                'code' => 200,
                'message' => 'Success',
                'data' => $category
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

    public function update(Request $request, string $category_id): JsonResponse
    {
        try {
            $category = KategoriModel::findOrFail($category_id);

            $category->update($request->all());

            return response()->json([
                'code' => 200,
                'message' => "Data Berhasil",
                'data' => $category
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

    public function destroy(string $category_id): JsonResponse
    {
        try {
            $category = KategoriModel::findOrFail($category_id);

            $category->delete();

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
