<?php

namespace App\Http\Controllers;

use App\Entidades\Aseguradora;
use App\Entidades\Seguro;
use App\Entidades\Poliza; //include_once "app/Entidades/Poliza.php";
use App\Entidades\Cliente; //include_once "app/Entidades/Poliza.php";
use App\Entidades\Sistema\Patente;
use App\Entidades\Sistema\Usuario;
use Illuminate\Http\Request;

require app_path() . '/start/constants.php';

class ControladorPoliza extends Controller
{

    public function index()
    {
        $titulo = "Polizas";
        if (Usuario::autenticado() == true) {
            if (!Patente::autorizarOperacion("POLIZACONSULTA")) {
                $codigo = "POLIZACONSULTA";
                $mensaje = "No tiene permisos para la operaci&oacute;n.";
                return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
            } else {
                return view('poliza.poliza-listado', compact('titulo'));
            }
        } else {
            return redirect('admin/login');
        }
    }

    public function nuevo()
    {
        $titulo = "Nueva Póliza";
        if (Usuario::autenticado() == true) {
            if (!Patente::autorizarOperacion("POLIZAALTA")) {
                $codigo = "POLIZAALTA";
                $mensaje = "No tiene pemisos para la operaci&oacute;n.";
                return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
            } else {

                $cliente = new Cliente();
                $array_clientes = $cliente->obtenerTodos();

                $aseguradora = new Aseguradora();
                $array_aseguradoras = $aseguradora->obtenerTodos();
                
                $seguro = new Seguro();
                $array_seguros = $seguro->obtenerTodos();
                return view('poliza.poliza-nuevo', compact('titulo', 'array_clientes', 'array_aseguradoras', 'array_seguros'));
            }
        } else {
            return redirect('admin/login');
        }
    }

    public function editar($id)
    {
        $titulo = "Modificar Poliza";
        if (Usuario::autenticado() == true) {
            if (!Patente::autorizarOperacion("POLIZAMODIFICACION")) {
                $codigo = "POLIZAMODIFICACION";
                $mensaje = "No tiene pemisos para la operaci&oacute;n.";
                return view('sistema.pagina-error', compact('titulo', 'codigo', 'mensaje'));
            } else {
                $poliza = new Poliza(); 
                $poliza->obtenerPorId($id);

                $cliente = new Cliente();
                $array_clientes = $cliente->obtenerTodos();

                $aseguradora = new Aseguradora();
                $array_aseguradoras = $aseguradora->obtenerTodos();
                
                $seguro = new Seguro();
                $array_seguros = $seguro->obtenerTodos();


                return view('poliza.poliza-nuevo', compact('poliza', 'titulo', 'array_clientes', 'array_aseguradoras',  'array_seguros'));
            }

        } else {
            return redirect('admin/login');
        }
    }

    public function eliminar(Request $request)
    {
        $id = $request->input('id');

        if (Usuario::autenticado() == true) {
            if (Patente::autorizarOperacion("POLIZABAJA")) {
                $entidad = new Poliza();
                $entidad->cargarDesdeRequest($request);

                $entidad->eliminar();
                $aResultado["err"] = EXIT_SUCCESS; //eliminado correctamente

            } else {
                $codigo = "POLIZABAJA";
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

        $entidad = new Poliza();
        $aPoliza = $entidad->obtenerFiltrado();

        $data = array();
        $cont = 0;

        $inicio = $request['start'];
        $registros_por_pagina = $request['length'];



        for ($i = $inicio; $i < count($aPoliza) && $cont < $registros_por_pagina; $i++) {
            $row = array();
            $row[] = '<a href="/admin/poliza/nuevo/' . $aPoliza[$i]->idpoliza . '">' . $aPoliza[$i]->numero_poliza .'</i></a>';
            $row[] = $aPoliza[$i]->cliente;
            $row[] = $aPoliza[$i]->fecha_emision;
            $row[] = $aPoliza[$i]->bien;
            $row[] = $aPoliza[$i]->riesgo;
            $row[] = $aPoliza[$i]->seguro;
            $row[] = $aPoliza[$i]->fecha_inicio;
            $row[] = $aPoliza[$i]->fecha_fin;
            $row[] = $aPoliza[$i]->endoso;
            $cont++;
            $data[] = $row;
        }

        $json_data = array(
            "draw" => intval($request['draw']),
            "recordsTotal" => count($aPoliza), //cantidad total de registros sin paginar
            "recordsFiltered" => count($aPoliza), //cantidad total de registros en la paginacion
            "data" => $data,
        );
        return json_encode($json_data);
    }

    
    

    public function guardar(Request $request)
    {
        //Define la entidad servicio
        $titulo = "Modificar póliza";
        $entidad = new Poliza();
        $entidad->cargarDesdeRequest($request);

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

        $id = $entidad->idpoliza;
        $poliza = new Poliza();
        $poliza->obtenerPorId($id);
        
        return view('poliza.poliza-listado', compact('titulo', 'msg'));
    }
    
}
