<?php

namespace App\Http\Controllers;

use App\Http\Resources\BarangResource;
use App\Models\BarangModel;
use App\Models\KategoriModel;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Yajra\DataTables\Facades\DataTables;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $listKategori = KategoriModel::all();

        $breadcrumb = (object) [
            'title' => 'Daftar Barang',
            'list' => ['Home', 'Barang']
        ];

        $page = (object) [
            'title' => 'Daftar barang yang terdaftar dalam sistem'
        ];

        $activeMenu = 'barang';

        return response()->view('pages.barang.index', [
            'listKategori' => $listKategori,
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu
        ]);
    }

    public function list(Request $request): JsonResponse
    {
        $listBarang = BarangModel::select('barang_id', 'kategori_id', 'barang_kode', 'barang_nama')
            ->with(['kategori']);

        if ($request->kategori_id) {
            $listBarang->where('kategori_id', $request->kategori_id);
        }

        return DataTables::of($listBarang)
            ->addIndexColumn()
            ->addColumn('aksi', function ($barang) {
                $btn = '<a href="' . url('/barang/' . $barang->barang_id) . '" class="btn btn-info btn-sm"><i class="bi bi-info mr-2"></i>Detail</a> ';
                $btn .= '<a href="' . url('/barang/' . $barang->barang_id . '/edit') . '"
                class="btn btn-warning btn-sm"><i class="bi bi-pencil-square mr-2"></i>Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="' .
                    url('/barang/' . $barang->barang_id) . '">'
                    . csrf_field() . method_field('DELETE') .
                    '<button type="submit" class="btn btn-danger btn-sm"
                onclick="return confirm(\'Apakah Anda yakit menghapus data
                ini?\');"><i class="bi bi-trash mr-2"></i>Hapus</button></form>';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        $listKategori = KategoriModel::all();

        $breadcrumb = (object) [
            'title' => 'Barang',
            'list' => ['Home', 'Barang', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah Barang'
        ];

        $activeMenu = 'barang';

        return response()->view('pages.barang.create', [
            'listKategori' => $listKategori,
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'barang_kode' => ['required', 'string', 'min:3', 'unique:m_barang,barang_kode'],
            'barang_nama' => ['required', 'string', 'min:3'],
            'harga_beli' => ['required', 'numeric'],
            'harga_jual' => ['required', 'numeric'],
            'kategori_id' => ['required', 'exists:m_kategori,kategori_id']
        ]);

        try {
            BarangModel::create($validated);

            return redirect('/barang')->with('success', 'Barang berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect('/barang')->with('error', 'Barang gagal ditambahkan');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): Response
    {
        $barang = BarangModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Barang',
            'list' => ['Home', 'Barang', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail Barang'
        ];

        $activeMenu = 'barang';

        return response()->view('pages.barang.show', [
            'barang' => $barang,
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id): Response
    {
        $listKategori = KategoriModel::all();
        $barang = BarangModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Barang',
            'list' => ['Home', 'Barang', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit Barang'
        ];

        $activeMenu = 'barang';

        return response()->view('pages.barang.edit', [
            'barang' => $barang,
            'listKategori' => $listKategori,
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $barang = BarangModel::find($id);
        $rules = [
            'barang_kode' => ['required', 'string', 'min:3'],
            'barang_nama' => ['required', 'string', 'min:3'],
            'harga_beli' => ['required', 'numeric'],
            'harga_jual' => ['required', 'numeric'],
            'kategori_id' => ['required', 'numeric']
        ];

        if ($request->barang_kode != $barang->barang_kode) {
            $rules['barang_kode'] = ['unique:m_barang,barang_kode'];
        }

        $validated = $request->validate($rules);

        try {
            $barang->update($validated);

            return redirect('/barang')->with('success', 'Barang berhasil diupdate');
        } catch (\Throwable $th) {
            return redirect('/barang')->with('error', 'Barang gagal diupdate');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): RedirectResponse
    {
        $barang = BarangModel::find($id);

        if (!$barang) {
            return redirect('/barang')->with('error', 'Barang tidak ditemukan');
        }

        try {
            $barang->delete();

            return redirect('/barang')->with('success', 'Barang berhasil dihapus');
        } catch (QueryException $e) {
            return redirect('/barang')->with('error', 'Barang gagal dihapus karena data masih digunakan');
        }
    }

    public function get(int $id): BarangResource
    {
        $barang = BarangModel::with([
            'stok' => function ($query) {
                $query->orderBy('stok_tanggal', 'desc')->first();
            }
        ])->find($id);

        return new BarangResource($barang);
    }
}
