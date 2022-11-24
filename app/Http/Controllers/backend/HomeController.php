<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{

    public function __construct()
    {
    }


    public function home()
    {
        return view('backend.home');
    }

    public function media()
    {
        return view('backend.media.index');
    }

    public function components()
    {
        return view('backend.components');
    }
}
