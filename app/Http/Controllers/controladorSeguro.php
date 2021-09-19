<?php

namespace App\Http\Controllers;

use App\Entidades\Aseguradora;
use App\Entidades\Seguro;
use App\Entidades\Sistema\Patente;
use App\Entidades\Sistema\Usuario;
use App\Entidades\TipoSeguro;
use Illuminate\Http\Request;

require app_path() . '/start/constants.php';

class ControladorSeguro extends Controller
{
    public function nuevo()
    {
        $titulo = "Nuevo Seguro";
        if (Usuario::autenticado() == true) {
            if (!Patente::autorizarOperacion("SEGUROSALTA")) {
                $codigo = "SEGUROSALTA";
                $mensaje = "No tiene pemisos para la operaci&oacute;n.";
                return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
            } else {
                $seguro = new Seguro();

                $aseguradora = new Aseguradora();
                $array_aseguradoras = $aseguradora->obtenerTodos();

                $tipo = new TipoSeguro();
                $array_tipos = $tipo->obtenerTodos();

                return view('seguro.seguro-nuevo', compact("titulo", 'seguro', 'array_aseguradoras', 'array_tipos'));
            }
        } else {
            return redirect('admin/login');
        }
    }
    public function index()
    {
        $titulo = "Seguros";
        if (Usuario::autenticado() == true) {
            if (!Patente::autorizarOperacion("SEGUROSCONSULTA")) {
                $codigo = "SEGUROSCONSULTA";
                $mensaje = "No tiene permisos para la operaci&oacute;n.";
                return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
            } else {
                return view('seguro.seguro-listar', compact('titulo'));
            }
        } else {
            return redirect('admin/login');
        }
    }

    public function editar($id)
    {
        $titulo = "Modificar Seguro";
        if (Usuario::autenticado() == true) {
            if (!Patente::autorizarOperacion("SEGUROSEDITAR")) {
                $codigo = "SEGUROSEDITAR";
                $mensaje = "No tiene pemisos para la operaci&oacute;n.";
                return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
            } else {
                $seguro = new Seguro();
                $seguro->obtenerPorId($id);

                $aseguradora = new Aseguradora();
                $array_aseguradoras = $aseguradora->obtenerTodos();

                $tipo = new TipoSeguro();
                $array_tipos = $tipo->obtenerTodos();

                return view('seguro.seguro-nuevo', compact('seguro', 'titulo', 'array_aseguradoras', 'array_tipos'));
            }
        } else {
            return redirect('admin/login');
        }
    }

    public function guardar(Request $request)
    {
        try {
            //Define la entidad servicio
            $titulo = "Modificar seguro";
            $entidad = new Seguro();
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
                $_POST["id"] = $entidad->idseguro;
                return view('seguro.seguro-listar', compact('titulo', 'msg'));
            }
        } catch (Exception $e) {
            $msg["ESTADO"] = MSG_ERROR;
            $msg["MSG"] = ERRORINSERT;
        }

        $id = $entidad->idseguro;
        $seguro = new Seguro();
        $seguro->obtenerPorId($id);

        return view('seguro.seguro-nuevo', compact('msg', 'seguro', 'titulo')) . '?id=' . $seguro->idseguro;
    }

    public function cargarGrilla()
    {
        $request = $_REQUEST;

        $entidadSeguro = new Seguro();
        $aSeguros = $entidadSeguro->obtenerFiltrado(); //preguntar si puede ser 'obtenerTodosPorFamilia'

        $data = array();

        $inicio = $request['start'];
        $registros_por_pagina = $request['length'];

        if (count($aSeguros) > 0) {
            $cont = 0;
        }

        for ($i = $inicio; $i < count($aSeguros) && $cont < $registros_por_pagina; $i++) {
            $row = array();
            $row[] = $aSeguros[$i]->nombre;
            $row[] = $aSeguros[$i]->descripcion;
            $row[] = $aSeguros[$i]->aseguradora;
            $row[] = $aSeguros[$i]->tipo;
            $row[] = "<i class='" . $aSeguros[$i]->icono . "'></i>";
            $row[] = "<a href='/admin/seguro/nuevo/" . $aSeguros[$i]->idseguro . "'><i class='fas fa-search'></i></a>";
            $cont++;
            $data[] = $row;
        }

        $json_data = array(
            "draw" => intval($request['draw']),
            "recordsTotal" => count($aSeguros), //cantidad total de registros sin paginar
            "recordsFiltered" => count($aSeguros), //cantidad total de registros en la paginacion
            "data" => $data,
        );
        return json_encode($json_data);
    }

    public function eliminar(Request $request)
    {
        $id = $request->input('id');

        if (Usuario::autenticado() == true) {
            if (Patente::autorizarOperacion("SEGUROSBAJA")) {

                $entidad = new Seguro();
                $entidad->cargarDesdeRequest($request);
                $entidad->eliminar();
                $aResultado["err"] = EXIT_SUCCESS; //eliminado correctamente

            } else {
                $codigo = "SEGUROSBAJA";
                $aResultado["err"] = "No tiene pemisos para la operaci&oacute;n.";
            }
            echo json_encode($aResultado);
        } else {
            return redirect('admin/login');
        }
    }
}
