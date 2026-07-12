<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    public function cgv()
    {
        return view('pages.cgv');
    }

    public function privacy()
    {
        return view('pages.privacy');
    }

    public function legal()
    {
        return view('pages.legal');
    }
}