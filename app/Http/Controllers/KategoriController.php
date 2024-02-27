<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KategoriController extends Controller
{
    public function index()
    {
        // $data = [
        //     'kategori_kode' => "SNK",
        //     "kategori_nama" => "Snack/Makanan Ringan",
        //     "created_at" => Carbon::now()
        // ];
        // DB::table("m_kategori")->insert($data);
        // return "Insert data baru berhasil";

        // $row = DB::table("m_kategori")->where("kategori_kode", "SNK")->update(['kategori_nama' => "Camilan"]);
        // return "Update data berhasil. Jumlah data yang diupdate $row baris";

        // $row = DB::table('m_kategori')->where('kategori_kode', 'SNK')->delete();
        // return "Update data berhasil. Jumlah data yang dihapus $row baris";

        $datas = DB::table('m_kategori')->get();
        return view('kategori', ['datas' => $datas]);
    }
}
