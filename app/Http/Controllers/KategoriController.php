<?php

namespace App\Http\Controllers;

use App\Models\KategoriModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Yajra\DataTables\Facades\DataTables;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Kategori',
            'list' => ['Home', 'Kategori']
        ];

        $page = (object) [
            'title' => 'Daftar kategori barang yang terdaftar dalam sistem'
        ];

        $activeMenu = 'kategori';

        return response()->view('pages.kategori.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu
        ]);
    }

    public function list(): JsonResponse
    {
        $listKategori = KategoriModel::select('kategori_id', 'kategori_kode', 'kategori_nama');

        return DataTables::of($listKategori)
            ->addIndexColumn()
            ->addColumn('aksi', function ($kategori) {
                $btn = '<a href="' . url('/kategori/' . $kategori->kategori_id) . '" class="btn btn-info btn-sm"><i class="bi bi-info mr-2"></i>Detail</a> ';
                $btn .= '<a href="' . url('/kategori/' . $kategori->kategori_id . '/edit') . '"
                class="btn btn-warning btn-sm"><i class="bi bi-pencil-square mr-2"></i>Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="' .
                    url('/kategori/' . $kategori->kategori_id) . '">'
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
        $breadcrumb = (object) [
            'title' => 'Tambah Kategori',
            'list' => ['Home', 'Kategori', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah kategori barang baru'
        ];

        $activeMenu = 'kategori';

        return response()->view('pages.kategori.create', [
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
            'kategori_kode' => ['required', 'string', 'min:3', 'unique:m_kategori,kategori_kode'],
            'kategori_nama' => ['required', 'string', 'min:3']
        ]);

        try {
            KategoriModel::create($validated);

            return redirect('/kategori')->with('success', 'Kategori baru berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect('/kategori')->with('error', 'Kategori gagal ditambahkan');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): Response
    {
        $kategori = KategoriModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Detail Kategori',
            'list' => ['Home', 'Kategori', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail data kategori'
        ];

        $activeMenu = 'kategori';

        return response()->view('pages.kategori.show', [
            'category' => $kategori,
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
        $category = KategoriModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Edit Kategori',
            'list' => ['Home', 'Kategori', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit data kategori '
        ];

        $activeMenu = 'kategori';

        return response()->view('pages.kategori.edit', [
            'category' => $category,
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
        $kategori = KategoriModel::find($id);
        $rules = [
            'kategori_kode' => ['required', 'string', 'min:3', 'unique:m_kategori,kategori_kode'],
            'kategori_nama' => ['required', 'string', 'min:3']
        ];

        if ($request->kategori_kode != $kategori->kategori_kode) {
            $rules['kategori_kode'] = ['required', 'string', 'min:3', 'unique:m_kategori,kategori_kode'];
        }

        $validated = $request->validate($rules);

        try {
            $kategori->update($validated);

            return redirect('/kategori')->with('success', 'Kategori berhasil diupdate');
        } catch (\Throwable $th) {
            return redirect('/kategori')->with('error', 'Kategori gagal diupdate');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): RedirectResponse
    {
        // $kategori = $this->crudService->find($id);

        try {
            KategoriModel::find($id)->delete();

            return redirect('/kategori')->with('success', 'Kategori berhasil dihapus');
        } catch (\Throwable $th) {
            return redirect('/kategori')->with('error', 'Kategori gagal dihapus');
        }
    }
}
