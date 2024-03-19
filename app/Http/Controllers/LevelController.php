<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class LevelController extends Controller
{
    public function index()
    {
        //
    }

    public function create(): Response
    {
        return response()->view('level.tambah');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'level_kode' => ['required', 'string'],
            'level_name' => ['required', 'string']
        ]);

        return redirect('/level');
    }
}
