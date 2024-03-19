<?php

namespace App\Http\Controllers;

use App\Models\LevelModel;
use App\Models\UserModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = UserModel::with('level')->get();
        return view('user', ['datas' => $users]);
    }

    public function tambah(): Response
    {
        $levels = LevelModel::all();
        return response()->view('user.tambah', [
            'levels' => $levels
        ]);
    }

    public function tambah_simpan(Request $request): RedirectResponse
    {
        UserModel::create([
            'username' => $request->username,
            'nama' => $request->nama,
            'password' => Hash::make($request->password),
            'level_id' => $request->level_id
        ]);

        return response()->redirectTo('/user');
    }

    public function ubah(int $id): Response
    {
        $user = UserModel::find($id);
        return response()->view('user_ubah', [
            'data' => $user
        ]);
    }

    public function ubah_simpan(int $id, Request $request): RedirectResponse
    {
        $user = UserModel::find($id);

        $user->username = $request->username;
        $user->nama = $request->nama;
        $user->level_id = $request->level_id;

        $user->save();
        return response()->redirectTo('/user');
    }

    public function hapus(int $id): RedirectResponse
    {
        $user = UserModel::find($id);
        $user->delete();

        return response()->redirectTo('/user');
    }
}
