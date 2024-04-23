<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BarangModel;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BarangController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            $products = BarangModel::all();

            return response()->json([
                'code' => 200,
                'message' => 'Success',
                'data' => $products
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
                'kategori_id' => 'required',
                'barang_kode' => 'required',
                'barang_nama' => 'required',
                'harga_beli' => 'required',
                'harga_jual' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $product = BarangModel::create($request->all());

            return response()->json([
                'code' => 201,
                'message' => 'Success',
                'data' => $product
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'code' => 500,
                'message' => $th->getMessage()
            ]);
        }
    }

    public function show(string $product_id): JsonResponse
    {
        try {
            $product = BarangModel::findOrFail($product_id);

            return response()->json([
                'code' => 200,
                'message' => 'Success',
                'data' => $product
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

    public function update(Request $request, string $product_id): JsonResponse
    {
        try {
            $product = BarangModel::findOrFail($product_id);

            $product->update($request->all());

            return response()->json([
                'code' => 200,
                'message' => "Data Berhasil",
                'data' => $product
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

    public function destroy(string $product_id): JsonResponse
    {
        try {
            $product = BarangModel::findOrFail($product_id);

            $product->delete();

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
