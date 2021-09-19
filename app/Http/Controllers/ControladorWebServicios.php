<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Entidades\Seguro;

class ControladorWebServicios extends Controller
{
    public function index()
    {
        $seguro = new Seguro();
        $array_seguros = $seguro->obtenerTodos();
        
       
        return view('web.servicios', compact('array_seguros'));
    }
}
?>