<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function dashboard()
    {
        return view('dashboard');
    }

    public function career()
    {
        return view('career');
    }

    public function scholarship()
    {
        return view('scholarship');
    }

    public function library()
    {
        return view('library');
    }

    public function profile()
    {
        return view('profile');
    }
}
