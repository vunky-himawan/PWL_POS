<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
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

        UserModel::destroy(8);

        // Praktikum 2.4 - Langkah 9
        $user = UserModel::firstOrNew(
            [
                'username' => 'manager33',
                'nama' => 'Manager Tiga Tiga',
                'password' => Hash::make(12345),
                'level_id' => 2
            ]
        );
        $user->save();

        return view('user', ['data' => $user]);
    }
}
