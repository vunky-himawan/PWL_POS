<?php

namespace App\Http\Controllers;

use App\Models\LevelModel;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Yajra\DataTables\Facades\DataTables;

class LevelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $breadcrumb = (object) [
            'title' => 'Daftar Level',
            'list' => ['Home', 'Level']
        ];

        $page = (object) [
            'title' => 'Daftar level yang terdaftar dalam sistem'
        ];

        $activeMenu = 'level';

        return response()->view('pages.level.index', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu
        ]);
    }

    public function list(): JsonResponse
    {
        $listLevel = LevelModel::select('level_id', 'level_kode', 'level_name');

        return DataTables::of($listLevel)
            ->addIndexColumn()
            ->addColumn('aksi', function ($level) {
                $btn = '<a href="' . url('/level/' . $level->level_id) . '" class="btn btn-info btn-sm"><i class="bi bi-info mr-2"></i>Detail</a> ';
                $btn .= '<a href="' . url('/level/' . $level->level_id . '/edit') . '"
                class="btn btn-warning btn-sm"><i class="bi bi-pencil-square mr-2"></i>Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="' .
                    url('/level/' . $level->level_id) . '">'
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
            'title' => 'Tambah Level',
            'list' => ['Home', 'Level', 'Tambah']
        ];

        $page = (object) [
            'title' => "Tambah Level Baru"
        ];

        $activeMenu = 'level';

        return response()->view('pages.level.create', [
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
            'level_kode' => ['required', 'string', 'min:3', 'unique:m_level,level_kode'],
            'level_name' => ['required', 'string', 'min:3'],
        ]);

        try {
            LevelModel::create($validated);

            return redirect('/level')->with('success', 'Level baru berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect('/level')->with('error', 'Level gagal ditambahkan');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): Response
    {
        $level = LevelModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Detail Level',
            'list' => ['Home', 'Level', 'Detail']
        ];

        $page = (object) [
            'title' => "Detail Level"
        ];

        $activeMenu = 'level';

        return response()->view('pages.level.show', [
            'breadcrumb' => $breadcrumb,
            'level' => $level,
            'page' => $page,
            'activeMenu' => $activeMenu
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id): Response
    {
        $level = LevelModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Edit Level',
            'list' => ['Home', 'Level', 'Edit']
        ];

        $page = (object) [
            'title' => "Edit Level"
        ];

        $activeMenu = 'level';

        return response()->view('pages.level.edit', [
            'breadcrumb' => $breadcrumb,
            'level' => $level,
            'page' => $page,
            'activeMenu' => $activeMenu
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $level = LevelModel::find($id);
        $rules = [
            'level_kode' => ['required', 'string', 'min:3', 'unique:m_level,level_kode'],
            'level_name' => ['required', 'string', 'min:3'],
        ];

        if ($level->level_kode != $request->level_kode) {
            $rules['level_kode'] = ['required', 'string', 'min:3', 'unique:m_level,level_kode'];
        }

        $validated = $request->validate($rules);


        try {
            $level->update($validated);

            return redirect('/level')->with('success', 'Level berhasil diupdate');
        } catch (\Exception $th) {
            return redirect('/level')->with('error', 'Level gagal diupdate');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): RedirectResponse
    {
        $level = LevelModel::find($id);

        if (!$level) {
            return redirect('/level')->with('error', 'Level tidak ditemukan');
        }

        try {
            $level->delete();

            return redirect('/level')->with('success', 'Level berhasil dihapus');
        } catch (QueryException $e) {
            return redirect('/level')->with('error', 'Level gagal dihapus karena ada data yang terkait dengan level ini');
        }
    }
}
