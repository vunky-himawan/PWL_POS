<?php

namespace App\Http\Controllers;

use App\DataTables\KategoriDataTable;
use App\Models\KategoriModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class KategoriController extends Controller
{
    public function index(KategoriDataTable $dataTable)
    {
        return $dataTable->render('kategori.index');
    }
    public function create(): Response
    {
        return response()->view('kategori.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validate = $request->validate([
            'kategori_kode' => 'bail|required|max:3|unique:kategoris',
            'kategori_nama' => 'required | max:50'
        ]);

        KategoriModel::create($validate);

        return redirect("/kategori");
    }

    public function edit(string $id): Response
    {
        $kategori = KategoriModel::find($id);
        return response()->view('kategori.edit', [
            'data' => $kategori
        ]);
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        KategoriModel::find($id)->update([
            'kategori_kode' => $request->kategori_kode,
            'kategori_nama' => $request->kategori_nama
        ]);

        return redirect("/kategori");
    }

    public function destroy(string $id): RedirectResponse
    {
        KategoriModel::destroy($id);
        return redirect("/kategori");
    }
}
