<?php

namespace App\Http\Controllers;

use App\DataTables\KategoriDataTable;
use App\Http\Requests\StorePostRequest;
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

    public function store(StorePostRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $validated = $request->safe()->only(['kategori_kode', 'kategori_nama']);
        $validated = $request->safe()->except(['kategori_kode', 'kategori_nama']);


        KategoriModel::create($validated);

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
