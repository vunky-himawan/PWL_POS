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

        $data = [
            'level_id' => 2,
            "username" => 'manager_tiga',
            'nama' => "Manager 3",
            'password' => Hash::make(12345)
        ];
        UserModel::create($data);

        $users = UserModel::all();
        return view('user', ['datas' => $users]);
    }
}
