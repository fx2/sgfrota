<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestesPdfController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('tests-pdf.index');
    }

    public function show($id) {
        return view('tests-pdf.show');
    }
}
