<?php

namespace App\Http\Controllers;

use App\Entidades\Aseguradora;
use App\Entidades\Sistema\Patente;
use App\Entidades\Sistema\Usuario;
use Illuminate\Http\Request;

require app_path() . '/start/constants.php';

class ControladorAseguradora extends Controller
{
    public function nuevo() {

            $titulo = "Nueva Aseguradora";
            if (Usuario::autenticado() == true) {
                if (!Patente::autorizarOperacion("ALTAASEGURADORA")) {
                    $codigo = "ALTAASEGURADORA";
                    $mensaje = "No tiene pemisos para la operaci&oacute;n.";
                    return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
                } else {
                    return view('aseguradora.aseguradora-nuevo', compact('titulo'));
                }
            } else {
                return redirect('admin/login');
        
        }

   }

    public function index() {
        $titulo = "Listado de aseguradoras";
        $titulo = "Aseguradora";
        if (Usuario::autenticado() == true) {
            if (!Patente::autorizarOperacion("ASEGURADORACONSULTA")) {
                $codigo = "ASEGURADORAACONSULTA";
                $mensaje = "No tiene permisos para la operaci&oacute;n.";
                return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
            } else {
                return view('aseguradora.aseguradora-listar', compact('titulo'));
            }
        } else {
            return redirect('admin/login');
        }
        
    }



  public function guardar(Request $request){

            try {
                //Define la entidad servicio
                $titulo = "Modificar aseguradora";
                $entidad = new Aseguradora();
                $entidad->cargarDesdeRequest($request);
    
                //validaciones
                if ($entidad->nombre == "") {
                    $msg["ESTADO"] = MSG_ERROR;
                    $msg["MSG"] = "Complete todos los datos";
                } else {
                    if ($_POST["id"] > 0) {
                        //Es actualizacion
                        $entidad->guardar();
    
                        $msg["ESTADO"] = MSG_SUCCESS;
                        $msg["MSG"] = OKINSERT;
                    } else {
                        //Es nuevo                       
                        $entidad->insertar();
                        
                        $msg["ESTADO"] = MSG_SUCCESS;
                        $msg["MSG"] = OKINSERT;
                    }
                    $_POST["id"] = $entidad->idaseguradora;
                    return view('aseguradora.aseguradora-listar', compact('titulo', 'msg'));
                }
            } catch (Exception $e) {
                $msg["ESTADO"] = MSG_ERROR;
                $msg["MSG"] = ERRORINSERT;
            }

            $id = $entidad->idaseguradora;
            $aseguradora = new Aseguradora();
            $aseguradora->obtenerPorId($id);
    
            return view('aseguradora.aseguradora-nuevo', compact('msg', 'aseguradora', 'titulo')) . '?id=' . $aseguradora->idaseguradora;
        }

        public function editar($id)
    {
        $titulo = "Modificar Aseguradora";
        if (Usuario::autenticado() == true) {
            if (!Patente::autorizarOperacion("EDITARASEGURADORA")) {
                $codigo = "EDITARASEGURADORA";
                $mensaje = "No tiene pemisos para la operaci&oacute;n.";
                return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
            } else {
                $aseguradora = new Aseguradora();
                $aseguradora->obtenerPorId($id);

                
                return view('aseguradora.aseguradora-nuevo', compact('aseguradora', 'titulo'));
            }
        } else {
            return redirect('admin/login');
        }
    }

  
    public function eliminar(Request $request)
    {
        if (Usuario::autenticado() == true) {
            if (!Patente::autorizarOperacion("ELIMINARASEGURADORA")) {
                $entidad = new Aseguradora();
                $entidad->cargarDesdeRequest($request);
                $entidad->eliminar();
                $aResultado["err"] = EXIT_SUCCESS; //eliminado correctamente

            } else {
                $codigo = "ELIMINARASEGURADORA";
                $aResultado["err"] = "No tiene pemisos para la operaci&oacute;n.";
            }
            echo json_encode($aResultado);
        } else {
            return redirect('admin/login');
        }
    }

    public function cargarGrilla()
    {
        $request = $_REQUEST;

        $entidadAseguradora = new Aseguradora();
        $aAseguradora = $entidadAseguradora->obtenerFiltrado();

        $data = array();
        $cont = 0;

        $inicio = $request['start'];
        $registros_por_pagina = $request['length'];



        for ($i = $inicio; $i < count($aAseguradora) && $cont < $registros_por_pagina; $i++) {
            $row = array();
            $row[] = $aAseguradora[$i]->nombre;
            $row[] = $aAseguradora[$i]->pagina_web;
            $row[] = $aAseguradora[$i]->telefono;
            $row[] = '<a href="/admin/aseguradora/nuevo/'. $aAseguradora[$i]->idaseguradora . '">' . '<i class="fas fa-search"></i></a>';
            $cont++;
            $data[] = $row;
        }

        $json_data = array(
            "draw" => intval($request['draw']),
            "recordsTotal" => count($aAseguradora), //cantidad total de registros sin paginar
            "recordsFiltered" => count($aAseguradora), //cantidad total de registros en la paginacion
            "data" => $data,
        );
        return json_encode($json_data);
    }

}
