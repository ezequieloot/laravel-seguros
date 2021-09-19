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

class ControladorReclamo extends Controller {

    public function index() {
        $titulo = "Reclamos";
        //validacion de autorizaciones
        if (Usuario::autenticado() == true) {
            if (!Patente::autorizarOperacion("RECLAMOCONSULTA")) {
                $codigo = "RECLAMOCONSULTA";
                $mensaje = "No tiene permisos para la operaci&oacute;n.";
                return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
            } else {
                return view('reclamo.reclamo-listar', compact('titulo'));
            }
        } else {
            return redirect('admin/login');
        }
    }

    public function nuevo() {
        $titulo = "Nuevo Reclamo";
        //validacion de autorizaciones
        if (Usuario::autenticado() == true) {
            if (!Patente::autorizarOperacion("RECLAMOSALTA")) {
                $codigo = "RECLAMOSALTA";
                $mensaje = "No tiene pemisos para la operaci&oacute;n.";
                return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
            } else {
                $estadoReclamo = new Reclamo_estado();
                $aEstados = $estadoReclamo->obtenerTodos();
        
                $tipoReclamo = new Tipo_reclamo();
                $aTipos = $tipoReclamo->obtenerTodos();
        
                $tipoPrioridad = new Tipo_prioridad();
                $aPrioridades = $tipoPrioridad->obtenerTodos();
        
                $seguro = new Seguro();
                $aSeguros = $seguro->obtenerTodos();
        
                return view('reclamo.reclamo-nuevo', compact('titulo', 'aEstados', 'aTipos', 'aPrioridades', 'aSeguros'));
            }
        } else {
            return redirect('admin/login');
        }

    }

    public function guardar(Request $request) {
        try {
            //Define la entidad reclamo
            $titulo = "Guardar Reclamo";
            $entidadReclamo = new Reclamo();
            $entidadReclamo->cargarDesdeRequest($request);

            //validaciones
            if ($entidadReclamo->codigo == "" ||
                $entidadReclamo->fecha == "" ||
                $entidadReclamo->fk_idestado == "" ||
                $entidadReclamo->fk_idtipo_prioridad == "" ||
                $entidadReclamo->fk_idtipo_reclamo == "" ||
                $entidadReclamo->fk_idseguro == "" ||
                $entidadReclamo->fk_idusuario == "" ||
                $entidadReclamo->descripcion == "") {
                    $msg["ESTADO"] = MSG_ERROR;
                    $msg["MSG"] = "Complete todos los datos";
            } else {
                if ($_POST["id"] > 0) {
                    //Inserta un mensaje
                    $entidadMensaje = new Reclamo_mensaje();
                    $entidadMensaje->cargarDesdeRequest($request);
                    if($entidadMensaje->mensaje != "") {
                        $entidadMensaje->insertar();
                    }
                    
                    //Actualiza un registro
                    $entidadReclamo->guardar();
                    $msg["ESTADO"] = MSG_SUCCESS;
                    $msg["MSG"] = OKINSERT;
                } else {
                    //Inserta un registro                     
                    $entidadReclamo->insertar();
                    $msg["ESTADO"] = MSG_SUCCESS;
                    $msg["MSG"] = OKINSERT;
                }
            }
        } catch (Exception $e) {
            $msg["ESTADO"] = MSG_ERROR;
            $msg["MSG"] = ERRORINSERT;
        }
        return view('reclamo.reclamo-listar', compact('titulo', 'msg'));
    }

    public function editar($id) {
        $titulo = "Editar Reclamos";
        if (Usuario::autenticado() == true) {
            if (!Patente::autorizarOperacion("RECLAMOSEDITAR")) {
                $codigo = "RECLAMOSEDITAR";
                $mensaje = "No tiene pemisos para la operaci&oacute;n.";
                return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
            } else {
                $reclamo = new Reclamo();
                $reclamo->obtenerPorId($id);

                $estado = new Reclamo_estado();
                $aEstados = $estado->obtenerTodos();
        
                $tipoReclamo = new Tipo_reclamo();
                $aTipos = $tipoReclamo->obtenerTodos();
        
                $tipoPrioridad = new Tipo_prioridad();
                $aPrioridades = $tipoPrioridad->obtenerTodos();
        
                $seguro = new Seguro();
                $aSeguros = $seguro->obtenerTodos();

                $mensaje = new Reclamo_mensaje();
                $aMensajes = $mensaje->obtenerPorReclamo($id);

                return view('reclamo.reclamo-nuevo', compact('titulo', 'reclamo', 'aEstados', 'aTipos', 'aPrioridades', 'aSeguros', 'aMensajes'));
            }
        } else {
            return redirect('admin/login');
        }
    }

    public function eliminar(Request $request) {
        if (Usuario::autenticado() == true) {
            if (Patente::autorizarOperacion("RECLAMOSBAJA")) {
                $reclamo = new Reclamo();
                $reclamo->cargarDesdeRequest($request);

                $mensaje = new Reclamo_mensaje();
                $mensaje->eliminarPorReclamo($reclamo->idreclamo);

                $reclamo->eliminar();
                $aResultado["err"] = EXIT_SUCCESS; //eliminado correctamente
            } else {
                $codigo = "RECLAMOSBAJA";
                $aResultado["err"] = "No tiene pemisos para la operaci&oacute;n.";
            }
            echo json_encode($aResultado);
        } else {
            return redirect('admin/login');
        }
    }

    public function cargarGrilla() {
        $request = $_REQUEST;

        $entidad = new Reclamo();
        $aReclamo = $entidad->obtenerFiltrado();

        $data = array();
        $cont = 0;

        $inicio = $request['start'];
        $registros_por_pagina = $request['length'];


        for ($i = $inicio; $i < count($aReclamo) && $cont < $registros_por_pagina; $i++) {
            $row = array();
            $row[] = '<a href="/admin/reclamo/nuevo/' . $aReclamo[$i]->idreclamo . '">' . $aReclamo[$i]->codigo . '</a>';
            $row[] = $aReclamo[$i]->fecha;
            $row[] = $aReclamo[$i]->estado;
            $row[] = $aReclamo[$i]->tipoprioridad;
            $row[] = $aReclamo[$i]->reclamo;
            $row[] = $aReclamo[$i]->seguro;
            $row[] = $aReclamo[$i]->usuario;
            $cont++;
            $data[] = $row;
        }

        $json_data = array(
            "draw" => intval($request['draw']),
            "recordsTotal" => count($aReclamo), //cantidad total de registros sin paginar
            "recordsFiltered" => count($aReclamo), //cantidad total de registros en la paginacion
            "data" => $data,
        );
        return json_encode($json_data);
    }

}
