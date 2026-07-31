<?php

namespace App\Http\Controllers;

class AdminUtamaController extends Controller
{
    public function index()
    {
        return view('admin_utama.dashboard');
    }
}
