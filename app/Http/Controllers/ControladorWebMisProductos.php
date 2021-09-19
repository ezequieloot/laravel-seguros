<?php

namespace App\Http\Controllers;


use App\Entidades\Cliente;
use App\Entidades\Poliza;
use App\Entidades\Reclamo;
use App\Entidades\Reclamo_mensaje;
use App\Entidades\Tipo_reclamo;
use App\Entidades\Seguro;
use App\Entidades\Sistema\Usuario;
use Illuminate\Http\Request;
use Session;
  
require app_path() . '/start/constants.php';

class ControladorWebMisProductos extends Controller {

    public function index(Request $request) {
        $cliente = new Cliente();
        $cliente->obtenerClientePorUsuario(Session::get("usuario_id"));

        $seguros = new Poliza();
        $array_seguros = $seguros->obtenerSegurosPorCliente($cliente->idcliente);

        $tipoReclamo = new Tipo_reclamo();
        $aTipos = $tipoReclamo->obtenerTodos();

        $seguro = new Seguro();
        $aSeguros = $seguro->obtenerTodos();

        return view('web.mis-productos', compact('array_seguros', 'aTipos', 'aSeguros'));
    }

    public function guardar(Request $request) {
        //Define la entidad reclamo
        $reclamo = new Reclamo();
        $reclamo->cargarDesdeRequest($request);
        $reclamo->insertar();

        $msg = "¡Gracias por comunicarte con nosotros, su reclamo se ha registrado exitosamente!";
        $aReclamos = $reclamo->obtenerPorUsuario(Session::get("usuario_id"));
        
        $mensaje = new Reclamo_mensaje();
        $aCantidadMensajes = array();
        for($i = 0; $i < count($aReclamos); $i++){
            $aCantidadMensajes[] = count($mensaje->obtenerPorReclamo($aReclamos[$i]->idreclamo));
        }

        return view('web.mis-reclamos', compact('msg', 'aReclamos', 'aCantidadMensajes'));
    }

}

?>