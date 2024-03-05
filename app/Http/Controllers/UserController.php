<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        // $data = [
        //     'username' => "customer-1",
        //     'nama' => "Pelanggan",
        //     "password" => Hash::make('12345'),
        //     "level_id" => 3
        // ];
        // UserModel::insert($data);

        // $data = [
        //     'nama' => "Pelanggan Pertama"
        // ];
        // UserModel::where('username', 'customer-1')->update($data);
        // $users = UserModel::all();
        // return view('user', ['datas' => $users]);

        // $data = [
        //     'level_id' => 2,
        //     "username" => 'manager_tiga',
        //     'nama' => "Manager 3",
        //     'password' => Hash::make(12345)
        // ];
        // UserModel::create($data);

        // $users = UserModel::all();
        // return view('user', ['datas' => $users]);

        // $user = UserModel::find(1);
        // return view('user', ['data' => $user]);

        // Praktikum 2.1 - langkah 4
        // $user = UserModel::where('level_id', 1)->first();
        // return view('user', ['data' => $user]);

        // Praktikum 2.1 - langkah 6
        // $user = UserModel::firstWhere('level_id', 1);
        // return view('user', ['data' => $user]);

        // Praktikum 2.1 - Langkah 8
        // $user = UserModel::findOr(1, ['username', 'nama'], function () {
        //     abort(404);
        // });
        // return view('user', ['data' => $user]);

        // Praktikum 2.2 - Langkah 1
        // $user = UserModel::findOrFail(1);
        // return view('user', ['data' => $user]);

        // Praktikum 2.2 - Langkah 3
        // $user = UserModel::where('username', 'manager9')->firstOrFail();
        // return view('user', ['data' => $user]);

        // Praktikum 2.3 - Langkah 1
        // $user = UserModel::where('level_id', 2)->count();
        // dd($user);
        // return view('user', ['data' => $user]);

        // Praktikum 2.4 - Langkah 1
        // $user = UserModel::firstOrCreate(
        //     [
        //         'username' => 'manager',
        //         'nama' => "Manager"
        //     ]
        // );
        // return view('user', ['data' => $user]);

        // Praktikum 2.4 - Langkah 4
        // $user = UserModel::firstOrCreate(
        //     [
        //         'username' => 'manager22',
        //         'nama' => 'Manager Dua Dua',
        //         'password' => Hash::make(12345),
        //         'level_id' => 2
        //     ]
        // );

        // return view('user', ['data' => $user]);

        // Praktikum 2.4 - Langkah 6
        // $user = UserModel::firstOrNew(
        //     [
        //         'username' => 'manager',
        //         'nama' => 'Manager',
        //     ]
        // );

        // return view('user', ['data' => $user]);

        // Praktikum 2.4 - Langkah 9
        // $user = UserModel::firstOrNew(
        //     [
        //         'username' => 'manager33',
        //         'nama' => 'Manager Tiga Tiga',
        //         'password' => Hash::make(12345),
        //         'level_id' => 2
        //     ]
        // );
        // $user->save();

        // return view('user', ['data' => $user]);


        // Praktikum 2.5 - Langkah 2
        // $user = UserModel::create(
        //     [
        //         'username' => 'manager55',
        //         'nama' => 'Manager55',
        //         'password' => Hash::make(12345),
        //         'level_id' => 2
        //     ]
        // );

        // $user->username = 'manager56';

        // $user->isDirty();
        // $user->isDirty('username');
        // $user->isDirty('nama');
        // $user->isDirty(['nama', 'username']);

        // $user->isClean();
        // $user->isClean('username');
        // $user->isClean('nama');
        // $user->isClean(['nama', 'username']);

        // $user->save();

        // $user->isDirty();
        // $user->isClean();
        // dd($user->isDirty());


        // Praktikum 2.5 - Langkah 3
        // $user = UserModel::create(
        //     [
        //         'username' => 'manager11',
        //         'nama' => 'Manager11',
        //         'password' => Hash::make(12345),
        //         'level_id' => 2
        //     ]
        // );

        // $user->username = 'manager12';

        // $user->save();

        // $user->wasChanged();
        // $user->wasChanged('username');
        // $user->wasChanged(['username', 'level_id']);
        // $user->wasChanged('nama');
        // dd($user->wasChanged(['nama', 'username']));

        // Praktikum 2.6 - Langkah 2
        // $users = UserModel::all();
        // return view('user', ['datas' => $users]);

        // Praktikum 2.7 - Langkah 2
        // $user = UserModel::with('level')->get();
        // dd($user);

        // Praktikum 2.7 - Langkah 4
        $users = UserModel::with('level')->get();
        return view('user', ['datas' => $users]);
    }

    public function tambah(): Response
    {
        return response()->view('user_tambah');
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
