<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ControladorWebSeguros extends Controller
{
    public function index()
    {
        return view('web.seguros');
    }
}
?>
