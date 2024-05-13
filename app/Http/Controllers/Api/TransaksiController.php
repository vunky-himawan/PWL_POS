<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BarangModel;
use App\Models\StokModel;
use App\Models\TransaksiModel;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TransaksiController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            $transaksi = TransaksiModel::all();

            return response()->json([
                'code' => 200,
                'message' => 'Success',
                'data' => $transaksi
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
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'pembeli' => 'required',
            'penjualan_kode' => 'required',
            'penjualan_tanggal' => 'required',
            'detail' => 'required|array',
            'detail.*.barang_id' => 'required',
            'detail.*.jumlah' => 'required',
        ], [
            'required' => ':attribute harus diisi'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        try {

            DB::beginTransaction();

            $transaksi = TransaksiModel::create([
                'user_id' => $request->user_id,
                'pembeli' => $request->pembeli,
                'penjualan_kode' => $request->penjualan_kode,
                'penjualan_tanggal' => $request->penjualan_tanggal,
                'total' => $request->total,
            ]);

            foreach ($request->detail as $key => $value) {
                $hargaBarang = BarangModel::find($value['barang_id'])->harga_jual;

                $transaksi->detail()->create([
                    'barang_id' => $value['barang_id'],
                    'penjualan_id' => $transaksi->id,
                    'harga' => $hargaBarang * $value['jumlah'],
                    'jumlah' => $value['jumlah'],
                ]);

                $stok = StokModel::where('barang_id', $value['barang_id'])->first();
                $stok->update([
                    'sisa' => $stok->sisa - $value['jumlah']
                ]);
            }

            DB::commit();

            return response()->json([
                'code' => 201,
                'message' => 'Data detail transaksi berhasil tersimpan',
                'data' => $request->all()
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'code' => 500,
                'message' => $th->getMessage()
            ]);
        }
    }

    public function show(string $transaksi_id): JsonResponse
    {
        try {
            $transaksi = TransaksiModel::with('detail')->find($transaksi_id);

            if (!$transaksi) {
                throw new ModelNotFoundException();
            }

            return response()->json([
                'code' => 200,
                'message' => 'Data detail transaksi ditemukan',
                'data' => $transaksi
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

    public function update(Request $request, string $transaksi_id): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'pembeli' => 'required',
            'penjualan_kode' => 'required',
            'penjualan_tanggal' => 'required',
            'detail' => 'required|array',
            'detail.*.barang_id' => 'required',
            'detail.*.jumlah' => 'required',
        ], [
            'required' => ':attribute harus diisi'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        try {
            $transaksi = TransaksiModel::with('detail')->find($transaksi_id);

            DB::beginTransaction();

            $transaksi->update([
                'user_id' => $request->user_id,
                'pembeli' => $request->pembeli,
                'penjualan_kode' => $request->penjualan_kode,
                'penjualan_tanggal' => $request->penjualan_tanggal,
            ]);

            foreach ($request->detail as $key => $value) {
                $harga = BarangModel::find($value['barang_id'])->harga_jual;
                $stok = StokModel::where('barang_id', $value['barang_id'])->first();

                if ($value['jumlah'] > $transaksi->detail[$key]->jumlah) {
                    $stok->update([
                        'sisa' => $stok->sisa + ($value['jumlah'] - $transaksi->detail[$key]->jumlah)
                    ]);
                } else if ($value['jumlah'] < $transaksi->detail[$key]->jumlah) {
                    $stok->update([
                        'sisa' => $stok->sisa - ($transaksi->detail[$key]->jumlah - $value['jumlah'])
                    ]);
                }

                $transaksi->detail[$key]->update([
                    'barang_id' => $value['barang_id'],
                    'penjualan_id' => $transaksi->penjualan_id,
                    'harga' => $value['jumlah'] * $harga,
                    'jumlah' => $value['jumlah'],
                ]);
            }

            DB::commit();

            return response()->json([
                'code' => 200,
                'message' => "Data berhasil diperbarui",
                'data' => $request->all()
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

    public function destroy(string $transaksi_id): JsonResponse
    {
        try {
            $transaksi = TransaksiModel::with('detail')->find($transaksi_id);

            DB::beginTransaction();

            foreach ($transaksi->detail as $key => $value) {
                $transaksi->detail[$key]->delete();
            }

            $transaksi->delete();

            DB::commit();

            return response()->json([
                'code' => 204,
                'message' => "Data berhasil dihapus",
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
