<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entidades\Sistema\Usuario;
use App\Entidades\Poliza;
use App\Entidades\Cliente;
use App\Entidades\Tipo_reclamo;
use App\Entidades\Seguro;
use Session;


require app_path() . '/start/constants.php';

class ControladorWebLogin extends Controller
{
    public function index()
    {

        return view('web.login');
    }


    public function logout(Request $request)
    {
        Session::flush();
        return redirect('/');
    }

    public function entrar(Request $request)
    {
        $usuarioIngresado = $request->input('txtUsuario');
        $claveIngresada = $request->input('txtClave');


        $usuario = new Usuario();
        $lstUsuario = $usuario->validarUsuario($usuarioIngresado);

        if (count($lstUsuario) > 0) {
            if ($usuario->validarClave($claveIngresada, $lstUsuario[0]->clave)) {
                $titulo = 'Inicio';
                $request->session()->put('usuario_id', $lstUsuario[0]->idusuario);
                $request->session()->put('usuario', $lstUsuario[0]->usuario);
                $request->session()->put('usuario_nombre', $lstUsuario[0]->nombre . " " . $lstUsuario[0]->apellido);

                $usuario->idusuario = $lstUsuario[0]->idusuario;
                $usuario->actualizarFechaIngreso();

                //Carga los grupos de cuentas de usuario
                /*grupo = new Area();
                $aGrupo = $grupo->obtenerAreasDelUsuario($lstUsuario[0]->idusuario);
                $request->session()->put('array_grupos', $aGrupo);*/

                //Grupo predeterminado
                if (isset($lstUsuario[0]->areapredeterminada) && $lstUsuario[0]->areapredeterminada != "")
                    $request->session()->put('grupo_id', $lstUsuario[0]->areapredeterminada);
                else
                    $request->session()->put('grupo_id', $aGrupo[0]->idarea);


                //Carga los permisos del usuario
                /* $familia = new Patente();
                $aPermisos = $familia->obtenerPatentesDelUsuario();
                if (count($aPermisos) > 0) {
                    $request->session()->put('array_permisos', $aPermisos);
                }*/

                $cliente = new Cliente();
                $cliente->obtenerClientePorUsuario(Session::get("usuario_id"));

                $seguros = new Poliza();
                $array_seguros = $seguros->obtenerSegurosPorCliente($cliente->idcliente);


                $tipoReclamo = new Tipo_reclamo();
                $aTipos = $tipoReclamo->obtenerTodos();

                $seguro = new Seguro();
                $aSeguros = $seguro->obtenerTodos();

                return view('web.mis-productos', compact('titulo', 'array_seguros', 'aTipos', 'aSeguros'));
            } else {
                $titulo = 'Acceso denegado';
                $msg["ESTADO"] = MSG_ERROR;
                $msg["MSG"] = "Credenciales incorrectas";
                return view('web.login', compact('titulo', 'msg'));
            }
        } else {
            $titulo = 'Acceso denegado';
            $msg["ESTADO"] = MSG_ERROR;
            $msg["MSG"] = "Credenciales incorrectas";
            return view('web.login', compact('titulo', 'msg'));
        }
    }
}
