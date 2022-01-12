<?php

namespace cactu\Http\Controllers;

use Illuminate\Http\Request;

class Manuales extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        return view('manuales.index');
    }

    public function versiones()
    {
        return view('manuales.versiones');
    }
}
