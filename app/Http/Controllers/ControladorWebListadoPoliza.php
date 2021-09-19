<?php

namespace App\Http\Controllers;

use App\Entidades\Poliza;
use App\Entidades\Cliente;
use App\Entidades\Seguro;
use Illuminate\Http\Request;
use App\Entidades\Sistema\Usuario;
use Session;
  

    require app_path() . '/start/constants.php';

    class ControladorWebListadoPoliza extends Controller
    {
    public function index($id)
    {
        if (Usuario::autenticado() == true) {

            $cliente = new Cliente();
            $cliente->obtenerClientePorUsuario(Session::get("usuario_id"));
            
            $poliza = new Poliza();
            $array_polizas = $poliza->obtenerPolizaPorSeguro($id, $cliente->idcliente);
             
            return view('web.listado-poliza', compact('array_polizas'));
            }else {
            return redirect('admin/login');
        }
    
    }
    }