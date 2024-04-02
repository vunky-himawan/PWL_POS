<?php

namespace App\Http\Controllers;

use App\Models\LevelModel;
use App\Models\UserModel;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index(): Response
    {
        $breadcrumb = (object) [
            'title' => 'Daftar User',
            'list' => ['Home', 'User']
        ];

        $page = (object) [
            'title' => 'Daftar user yang terdaftar dalam sistem'
        ];

        $activeMenu = 'user';

        $level = LevelModel::all();

        return response()->view('pages.user.index', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu,
            'page' => $page,
            'level' => $level
        ]);
    }

    public function list(Request $request)
    {
        $users = UserModel::select('user_id', 'username', 'nama', 'level_id')
            ->with('level');

        if ($request->level_id) {
            $users->where('level_id', $request->level_id);
        }

        return DataTables::of($users)
            ->addIndexColumn()
            ->addColumn('aksi', function ($user) {
                $btn = '<a href="' . url('/user/' . $user->user_id) . '" class="btn btn-info btn-sm"><i class="bi bi-info mr-2"></i>Detail</a> ';
                $btn .= '<a href="' . url('/user/' . $user->user_id . '/edit') . '"
                class="btn btn-warning btn-sm"><i class="bi bi-pencil-square mr-2"></i>Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="' .
                    url('/user/' . $user->user_id) . '">'
                    . csrf_field() . method_field('DELETE') .
                    '<button type="submit" class="btn btn-danger btn-sm"
                onclick="return confirm(\'Apakah Anda yakit menghapus data
                ini?\');"><i class="bi bi-trash mr-2"></i>Hapus</button></form>';
                return $btn;
            })
            ->rawColumns(['aksi']) // memberitahu bahwa kolom aksi adalah html
            ->make(true);
    }

    public function create(): Response
    {
        $breadcrumb = (object) [
            'title' => 'Tambah User',
            'list' => ['Home', 'User', 'Tambah']
        ];

        $page = (object) [
            'title' => "Tambah User Baru"
        ];

        $level = LevelModel::all();
        $activeMenu = 'user';

        return response()->view('pages.user.create', [
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'level' => $level,
            'activeMenu' => $activeMenu
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'username' => 'required | string | min:3 | unique:m_user,username',
            'nama' => 'required | string | max:100',
            'password' => 'required | min:5',
            'level_id' => 'required | integer'
        ]);

        UserModel::create([
            'username' => $request->username,
            'nama' => $request->nama,
            'password' => bcrypt($request->password),
            'level_id' => $request->level_id
        ]);

        return redirect('/user')->with('success', 'Data user berhasil disimpan');
    }

    public function show(string $id): Response
    {
        $user = UserModel::with('level')->find($id);

        $breadcrumb = (object) [
            'title' => 'Detail User',
            'list' => ['Home', 'User', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail User'
        ];

        $activeMenu = 'user';

        return response()->view('pages.user.show', [
            'user' => $user,
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu
        ]);
    }

    public function edit(string $id): Response
    {
        $user = UserModel::find($id);
        $level = LevelModel::all();
        
        $breadcrumb = (object) [
            'title' => 'Edit User',
            'list' => ['Home', 'User', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit User'
        ];

        $activeMenu = 'user';

        return response()->view('pages.user.edit', [
            'user' => $user,
            'level' => $level,
            'breadcrumb' => $breadcrumb,
            'page' => $page,
            'activeMenu' => $activeMenu
        ]);
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $user = UserModel::find($id);
        $rules = [
            'nama' => 'required | string | max:100',
            'password' => 'nullable | min:5',
            'level_id' => 'required | integer'
        ];

        if ($user->username != $request->username) {
            $rules['username'] = 'required | string | min:3 | unique:m_user,username';
        }

        $request->validate($rules);

        UserModel::find($id)->update([
            'username' => $request->username,
            'nama' => $request->nama,
            'password' => $request->password ? bcrypt($request->password) : UserModel::find($id)->password,
            'level_id' => $request->level_id
        ]);

        return redirect('/user')->with('success', 'Data user berhasil diubah');
    }

    public function destroy(string $id): RedirectResponse
    {
        $check = UserModel::find($id);
        if (!$check) {
            return redirect('/user')->with('error', 'Data user tidak ditemukan');
        }

        try {
            UserModel::destroy($id);

            return redirect('/user')->with('success', 'Data user berhasil dihapus');
        } catch (QueryException $e) {
            return redirect('/user')->with('error', 'Data user gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
}
