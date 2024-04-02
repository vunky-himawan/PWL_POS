<?php

namespace App\Http\Controllers;

use App\Models\BarangModel;
use App\Models\DetailTransaksiModel;
use App\Models\KategoriModel;
use App\Models\StokModel;
use App\Models\TransaksiModel;
use App\Models\UserModel;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $listKategori = KategoriModel::all();
        $listBarang = BarangModel::all();
        $listUser = UserModel::all();

        $breadcrumb = (object) [
            'title' => 'Transaksi',
            'list' => ['Home', 'Transaksi']
        ];

        $page = (object) [
            'title' => 'Daftar transaksi yang dilakukan',
        ];

        $activeMenu = 'penjualan';

        return response()->view('pages.transaksi.index', [
            'listKategori' => $listKategori,
            'listBarang' => $listBarang,
            'listUser' => $listUser,
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu
        ]);
    }

    public function list(Request $request): JsonResponse
    {
        $listTransaksi = TransaksiModel::select('t_penjualan.penjualan_id', 't_penjualan.user_id', 'pembeli', 'penjualan_kode', 'penjualan_tanggal')
            ->join('t_penjualan_detail', 't_penjualan_detail.penjualan_id', '=', 't_penjualan.penjualan_id')
            ->join('m_barang', 't_penjualan_detail.barang_id', '=', 'm_barang.barang_id')
            ->with(['user', 'detail', 'detail.barang']);

        if ($request->user_id) {
            $listTransaksi->where('t_penjualan.user_id', $request->user_id);
        }

        if ($request->kategori_id) {
            $listTransaksi->where('m_barang.kategori_id', $request->kategori_id);
        }

        if ($request->barang_id) {
            $listTransaksi->where('t_penjualan_detail.barang_id', $request->barang_id);
        }

        if ($request->tahun) {
            $listTransaksi->whereYear('penjualan_tanggal', $request->tahun);
        }

        if ($request->bulan) {
            $listTransaksi->whereMonth('penjualan_tanggal', $request->bulan);
        }

        if ($request->penjualan_kode == 'UPDATED') {
            $listTransaksi->where('penjualan_kode', 'like', '%UPDATED%');
        } else if ($request->penjualan_kode == 'ORIGINAL') {
            $listTransaksi->where('penjualan_kode', 'not like', '%UPDATED%');
        }

        return DataTables::of($listTransaksi)
            ->addIndexColumn()
            ->addColumn('aksi', function ($transaksi) {
                $btn = '<a href="' . url('/transaksi/' . $transaksi->penjualan_id) . '" class="btn btn-info btn-sm"><i class="bi bi-info mr-2"></i>Detail</a> ';
                $btn .= '<a href="' . url('/transaksi/' . $transaksi->penjualan_id . '/edit') . '"
                class="btn btn-warning btn-sm"><i class="bi bi-pencil-square mr-2"></i>Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="' .
                    url('/transaksi/' . $transaksi->penjualan_id) . '">'
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
        $listBarang = BarangModel::whereHas('stok', function ($q) {
            $q->where('sisa', '>', 0);
        })->with(['stok'])->get();

        $kodePenjualan = "TRANS" . date('YmdHis') . (TransaksiModel::count());
        $listUser = UserModel::all();

        $breadcrumb = (object) [
            'title' => 'Transaksi',
            'list' => ['Home', 'Transaksi', 'Tambah Transaksi']
        ];

        $page = (object) [
            'title' => 'Tambah transaksi',
        ];

        $activeMenu = 'penjualan';

        return response()->view('pages.transaksi.create', [
            'today' => Carbon::now()->format('Y-m-d'),
            'barangs' => $listBarang,
            'kodePenjualan' => $kodePenjualan,
            'users' => $listUser,
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
        $dateTime = Carbon::createFromFormat('Y-m-d', $request['penjualan_tanggal'])
            ->setTime(Carbon::now()->format('H'), Carbon::now()->format('i'), Carbon::now()->format('s'));

        $request->validate([
            'penjualan_kode' => ['required', 'max:50', 'unique:t_penjualan,penjualan_kode'],
            'penjualan_tanggal' => ['required', 'date'],
            'user_id' => ['required', 'exists:m_user,user_id'],
            'pembeli' => ['required', 'string', 'max:50'],
            'barang_id' => ['required', 'array', 'min:1', 'exists:m_barang,barang_id'],
            'jumlah' => ['required', 'array', 'min:1'],
            'harga' => ['required', 'array', 'min:1'],
        ]);
        try {

            DB::beginTransaction();

            $transaksi = new TransaksiModel();
            $transaksi->penjualan_kode = $request['penjualan_kode'];
            $transaksi->penjualan_tanggal = $dateTime;
            $transaksi->user_id = $request['user_id'];
            $transaksi->pembeli = $request['pembeli'];
            $transaksi->save();

            foreach ($request['barang_id'] as $key => $barang_id) {
                $detail = new DetailTransaksiModel();
                $detail->penjualan_id = $transaksi->penjualan_id;
                $detail->barang_id = $barang_id;
                $detail->jumlah = $request['jumlah'][$key];
                $detail->harga = $request['harga'][$key];
                $detail->save();

                $stok = StokModel::with(['barang'])
                    ->where('barang_id', $barang_id)
                    ->orderBy('stok_tanggal', 'desc')
                    ->first();

                StokModel::find($stok->stok_id)->update([
                    'sisa' => $stok->sisa - $request['jumlah'][$key],
                ]);
            }

            DB::commit();

            return redirect('/transaksi')->with('success', 'Data transaksi berhasil ditambahkan');
        } catch (Exception $e) {
            DB::rollback();

            return redirect('/transaksi')->with('error', 'Data transaksi gagal ditambahkan');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): Response
    {
        $breadcrumb = (object) [
            'title' => 'Transaksi',
            'list' => ['Home', 'Transaksi', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail transaksi',
        ];

        $activeMenu = 'penjualan';

        $transaksi = TransaksiModel::with(['user', 'user.level', 'detail', 'detail.barang', 'updatedBy'])->find($id);

        return response()->view('pages.transaksi.show', [
            'transaksi' => $transaksi,
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
        $transaksi = TransaksiModel::with(['user', 'user.level', 'detail', 'detail.barang'])->find($id);
        $listBarang = BarangModel::all();
        $listUser = UserModel::all();

        $breadcrumb = (object) [
            'title' => 'Transaksi',
            'list' => ['Home', 'Transaksi', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit transaksi',
        ];

        $activeMenu = 'penjualan';

        return response()->view('pages.transaksi.edit', [
            'transaksi' => $transaksi,
            'listBarang' => $listBarang,
            'listUser' => $listUser,
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
        $transaksi = TransaksiModel::find($id);
        $existDetail = DetailTransaksiModel::where('penjualan_id', $id)->pluck('barang_id');
        $deletedDetail = $existDetail->diff(collect($request['barang_id']));
        $penjualan_kode = str_contains($transaksi->penjualan_kode, '-UPDATED') ? $transaksi->penjualan_kode : $transaksi->penjualan_kode . '-UPDATED';
        $request['penjualan_kode'] = str_contains($request['penjualan_kode'], '-UPDATED') ? $request['penjualan_kode'] : $request['penjualan_kode'] . '-UPDATED';


        $request->validate([
            'penjualan_kode' => ['required', 'max:50'],
            'penjualan_tanggal' => ['required', 'date'],
            'user_id' => ['required', 'exists:m_user,user_id'],
            'pembeli' => ['required', 'string', 'max:50'],
            'barang_id' => ['required', 'array', 'min:1', 'exists:m_barang,barang_id'],
            'updated_by' => ['required', 'exists:m_user,user_id'],
            'jumlah' => ['required', 'array', 'min:1'],
            'harga' => ['required', 'array', 'min:1'],
        ]);

        try {

            DB::beginTransaction();


            TransaksiModel::find($id)->update([
                'updated_by' => $request['updated_by'],
                'penjualan_kode' => $request['penjualan_kode'] === $transaksi->penjualan_kode ? $penjualan_kode : $request['penjualan_kode'],
                'penjualan_tanggal' => $request['penjualan_tanggal'] === $transaksi->penjualan_tanggal ? $transaksi->penjualan_tanggal : $request['penjualan_tanggal'],
                'user_id' => $request['user_id'] === $transaksi->user_id ? $transaksi->user_id : $request['user_id'],
                'pembeli' => $request['pembeli'] === $transaksi->pembeli ? $transaksi->pembeli : $request['pembeli'],
            ]);

            foreach ($deletedDetail as $key => $value) {
                $detailWillDelete = DetailTransaksiModel::where(['penjualan_id' => $id, 'barang_id' => $value])->first();

                $stok = StokModel::where('barang_id', $value)
                    ->orderBy('stok_tanggal', 'desc')
                    ->first();

                StokModel::find($stok->stok_id)->update([
                    'sisa' => $stok->sisa + $detailWillDelete->jumlah
                ]);

                DetailTransaksiModel::where(['penjualan_id' => $id, 'barang_id' => $value])->delete();
            }

            $detail = DetailTransaksiModel::where('penjualan_id', $id)->get();

            foreach ($request['barang_id'] as $key => $value) {

                if (isset($detail[$key]) && $value == $detail[$key]->barang_id) {
                    DetailTransaksiModel::find($detail[$key]->detail_id)->update([
                        'penjualan_id' => $transaksi->penjualan_id,
                        'barang_id' => (int) $request['barang_id'][$key],
                        'jumlah' => $request['jumlah'][$key],
                        'harga' => $request['harga'][$key],
                    ]);

                    $stok = StokModel::where('barang_id', $request['barang_id'][$key])
                        ->orderBy('stok_tanggal', 'desc')
                        ->first();

                    if ($detail[$key]->jumlah <= $request['jumlah'][$key]) {

                        StokModel::find($stok->stok_id)->update([
                            'sisa' => $stok->sisa - ($request['jumlah'][$key] - $detail[$key]->jumlah)
                        ]);

                    } else {

                        StokModel::find($stok->stok_id)->update([
                            'sisa' => $stok->sisa + ($request['jumlah'][$key] - $detail[$key]->jumlah)
                        ]);

                    }
                } else {
                    DetailTransaksiModel::create([
                        'penjualan_id' => $id,
                        'barang_id' => $request['barang_id'][$key],
                        'jumlah' => $request['jumlah'][$key],
                        'harga' => $request['harga'][$key],
                    ]);

                    $stok = StokModel::where('barang_id', $request['barang_id'][$key])
                        ->orderBy('stok_tanggal', 'desc')
                        ->first();

                    StokModel::find($stok->stok_id)->update([
                        'sisa' => $stok->sisa - $request['jumlah'][$key]
                    ]);
                }
            }

            DB::commit();

            return redirect('/transaksi')->with('success', 'Data transaksi berhasil diubah');
        } catch (Exception $e) {
            DB::rollback();

            return redirect('/transaksi')->with('error', 'Data transaksi gagal diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): RedirectResponse
    {
        $detailTransaksi = DetailTransaksiModel::where('penjualan_id', $id);
        $transaksi = TransaksiModel::find($id);

        if (!$transaksi && !$detailTransaksi) {
            return redirect('/transaksi')->with('error', 'Data transaksi tidak ditemukan');
        }

        try {
            $detailTransaksi->delete();
            $transaksi->delete();

            return redirect('/transaksi')->with('success', 'Data transaksi berhasil dihapus');
        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect('/transaksi')->with('error', 'Data transaksi gagal dihapus');
        }
    }
}
