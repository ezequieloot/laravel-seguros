<?php 
namespace App\Http\Controllers;

use App\Entidades\Reclamo;
use App\Entidades\Reclamo_estado;
use App\Entidades\Tipo_prioridad;
use App\Entidades\Tipo_reclamo;
use App\Entidades\Seguro;
use App\Entidades\Reclamo_mensaje;
use App\Entidades\Sistema\Patente;
use App\Entidades\Sistema\Usuario;
use Illuminate\Http\Request;
use Session;

require app_path() . '/start/constants.php';

class ControladorWebReclamo extends Controller{

    public function index(Request $request) {
        $reclamo = new Reclamo();
        $reclamo->obtenerPorId($request["id"]);
    
        $mensaje = new Reclamo_mensaje();
        $aMensajes = $mensaje->obtenerPorReclamo($request["id"]);
    
        return view('web.reclamo', compact('reclamo', 'aMensajes'));
    }

    public function guardar(Request $request) {
        $reclamo = new Reclamo();
        $reclamo->cargarDesdeRequest($request);
        
        $mensaje = new Reclamo_mensaje();
        $mensaje->cargarDesdeRequest($request);
        
        //Valida si hay un mensaje para insertar
        if($mensaje->mensaje != "") {
            $mensaje->insertar();
            $msg = "¡Gracias por comunicarte con nosotros, su mensaje se ha registrado exitosamente!";
        }
        
        $aReclamos = $reclamo->obtenerPorUsuario(Session::get("usuario_id"));
        $aCantidadMensajes = array();
        for($i = 0; $i < count($aReclamos); $i++){
            $aCantidadMensajes[] = count($mensaje->obtenerPorReclamo($aReclamos[$i]->idreclamo));
        }

        return view('web.mis-reclamos', compact('msg', 'aReclamos', 'aCantidadMensajes'));
    }

    public function eliminar(Request $request) {
        $reclamo = new Reclamo();
        $reclamo->obtenerPorId($request["id"]);
        
        $mensaje = new Reclamo_mensaje();
        $mensaje->eliminarPorReclamo($reclamo->idreclamo);
        
        $reclamo->eliminar();
        $aReclamos = $reclamo->obtenerPorUsuario(Session::get("usuario_id"));

        $aCantidadMensajes = array();
        for($i = 0; $i < count($aReclamos); $i++){
            $aCantidadMensajes[] = count($mensaje->obtenerPorReclamo($aReclamos[$i]->idreclamo));
        }
        $msg = "¡Su reclamo se ha eliminado exitosamente!";

        return view('web.mis-reclamos', compact('msg', 'aReclamos', 'aCantidadMensajes'));

    }

}

?>
