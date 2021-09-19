<?php 
namespace App\Http\Controllers;

use App\Entidades\Reclamo;
use App\Entidades\Reclamo_mensaje;
use App\Entidades\Sistema\Patente;
use App\Entidades\Sistema\Usuario;
use Illuminate\Http\Request;
use Session;

require app_path() . '/start/constants.php';

class ControladorWebMisReclamos extends Controller{
    public function Index() {
        $reclamo = new Reclamo();
        $aReclamos = $reclamo->obtenerPorUsuario(Session::get("usuario_id"));

        $mensaje = new Reclamo_mensaje();
        $aCantidadMensajes = array();
        for($i = 0; $i < count($aReclamos); $i++){
            $aCantidadMensajes[] = count($mensaje->obtenerPorReclamo($aReclamos[$i]->idreclamo));
        }

        return view('web.mis-reclamos', compact('aReclamos', 'aCantidadMensajes'));
    }
}

?>