<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class WelcomeController extends Controller
{
    public function index(): Response
    {
        $breadcrumb = (object) [
            'title' => "Selamat Datang",
            "list" => ["Home", "Welcome"]
        ];

        $activeMenu = 'dashboard';

        return response()->view('welcome', [
            'breadcrumb' => $breadcrumb,
            'activeMenu' => $activeMenu
        ]);
    }
}
