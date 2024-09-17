<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Ambil data yang diperlukan untuk dashboard
        return view('admin.dashboard');
    }

    public function home()
    {
        return view('admin.home');
    }
}
