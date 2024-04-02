<?php

namespace App\Http\Controllers;

use App\Models\BarangModel;
use App\Models\KategoriModel;
use App\Models\StokModel;
use App\Models\UserModel;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Yajra\DataTables\Facades\DataTables;

class StokController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $listKategori = KategoriModel::all();
        $listUser = UserModel::all();
        $listBarang = BarangModel::all();

        $breadcrumb = (object) [
            'title' => 'Stok Barang',
            'list' => ['Home', 'Stok']
        ];

        $page = (object) [
            'title' => 'Daftar stok barang yang tersedia di sistem',
        ];

        $activeMenu = 'stok';

        return response()->view('pages.stok.index', [
            'listUser' => $listUser,
            'listBarang' => $listBarang,
            'listKategori' => $listKategori,
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu
        ]);
    }

    public function list(Request $request): JsonResponse
    {
        $listStok = StokModel::select('t_stok.stok_id', 't_stok.barang_id', 't_stok.user_id', 'stok_tanggal', 'stok_jumlah', 'sisa')
            ->join('m_barang', 'm_barang.barang_id', '=', 't_stok.barang_id')
            ->with(['barang', 'user']);

        if ($request->user_id) {
            $listStok->where('t_stok.user_id', $request->user_id);
        }

        if ($request->kategori_id) {
            $listStok->where('m_barang.kategori_id', $request->kategori_id);
        }

        if ($request->barang_id) {
            $listStok->where('t_stok.barang_id', $request->barang_id);
        }

        if ($request->tahun) {
            $listStok->whereYear('stok_tanggal', $request->tahun);
        }

        if ($request->bulan) {
            $listStok->whereMonth('stok_tanggal', $request->bulan);
        }

        return DataTables::of($listStok)
            ->addIndexColumn()
            ->addColumn('aksi', function ($stok) {
                $btn = '<a href="' . url('/stok/' . $stok->stok_id) . '" class="btn btn-info btn-sm"><i class="bi bi-info mr-2"></i>Detail</a> ';
                $btn .= '<a href="' . url('/stok/' . $stok->stok_id . '/edit') . '"
                class="btn btn-warning btn-sm"><i class="bi bi-pencil-square mr-2"></i>Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="' .
                    url('/stok/' . $stok->stok_id) . '">'
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
        $today = Carbon::now()->format('Y-m-d');
        $listBarang = BarangModel::all();
        $listUser = UserModel::all();

        $breadcrumb = (object) [
            'title' => 'Stok Barang',
            'list' => ['Home', 'Stok', 'Tambah']
        ];

        $page = (object) [
            'title' => 'Tambah stok',
        ];

        $activeMenu = 'stok';

        return response()->view('pages.stok.create', [
            'today' => $today,
            'listUser' => $listUser,
            'listBarang' => $listBarang,
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
            'barang_id' => ['required', 'exists:m_barang,barang_id',],
            'user_id' => ['required', 'exists:m_user,user_id'],
            'stok_tanggal' => ['required', 'date'],
            'stok_jumlah' => ['required', 'min:1'],
        ]);

        $dateTime = Carbon::createFromFormat('Y-m-d', $request['stok_tanggal'])
            ->setTime(Carbon::now()->format('H'), Carbon::now()->format('i'), Carbon::now()->format('s'));

        $validated['stok_tanggal'] = $dateTime;
        $validated['sisa'] = $validated['stok_jumlah'];

        try {
            StokModel::create($validated);

            return redirect('/stok')->with('success', 'Stok berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect('/stok')->with('error', 'Stok gagal ditambahkan');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): Response
    {
        $stok = StokModel::with(['barang.kategori', 'user'])->find($id);

        $breadcrumb = (object) [
            'title' => 'Stok Barang',
            'list' => ['Home', 'Stok', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail data stok'
        ];

        $activeMenu = 'stok';

        return response()->view('pages.stok.show', [
            'stok' => $stok,
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
        $stok = StokModel::find($id);
        $listBarang = BarangModel::all();
        $listUser = UserModel::all();

        $breadcrumb = (object) [
            'title' => 'Stok Barang',
            'list' => ['Home', 'Stok', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit data stok ' . $stok->stok_id
        ];

        $activeMenu = 'stok';

        return response()->view('pages.stok.edit', [
            'listUser' => $listUser,
            'listBarang' => $listBarang,
            'stok' => $stok,
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
        $stok = StokModel::find($id);
        $validated = $request->validate([
            'barang_id' => ['required', 'exists:m_barang,barang_id',],
            'user_id' => ['required', 'exists:m_user,user_id'],
            'sisa' => ['required'],
            'stok_tanggal' => ['required', 'date'],
            'stok_jumlah' => ['required', 'min:1', 'numeric'],
        ]);

        $dateTime = Carbon::createFromFormat('Y-m-d', $request['stok_tanggal'])
            ->setTime(Carbon::now()->format('H'), Carbon::now()->format('i'), Carbon::now()->format('s'));

        $validated['stok_tanggal'] = $request['stok_tanggal'] == $stok->stok_tanggal ? $stok->stok_tanggal : $dateTime;

        try {
            StokModel::find($id)->update($validated);

            return redirect('/stok')->with('success', 'Stok berhasil diubah');
        } catch (\Throwable $th) {
            return redirect('/stok')->with('error', 'Stok gagal diubah');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): RedirectResponse
    {
        $stok = StokModel::find($id);

        if (!$stok) {
            return redirect('/stok')->with('error', 'Stok tidak ditemukan');
        }

        try {
            $stok->delete();

            return redirect('/stok')->with('success', 'Stok berhasil di hapus');
        } catch (QueryException $e) {
            return redirect('/stok')->with('error', "Gagal menghapus stok karena");
        }
    }
}
