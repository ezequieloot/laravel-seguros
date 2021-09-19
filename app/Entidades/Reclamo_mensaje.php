<?php

namespace App\Entidades;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;

class Reclamo_mensaje extends Model {
    protected $table = 'reclamo_mensajes';
    public $timestamps = false;
    protected $fillable = [
        'idmensaje', 'fecha', 'fk_idreclamo', 'fk_idusuario', 'mensaje'
    ];
    protected $hidden = [
    ];

    public function cargarDesdeRequest($request) {
        //Por definir si es necesario cargar el idmensaje para modificar o eliminar mensajes 
        $this->idmensaje = $request->input('idmensaje') != "0" ? $request->input('idmensaje') : $this->idmensaje;
        $this->fecha = date("Y-m-d");
        $this->fk_idreclamo = $request->input('txtReclamo');
        $this->fk_idusuario = Session::get('usuario_id');
        $this->mensaje = $request->input("txtMensaje");
    }

    public function obtenerTodos() {
        $sql = "SELECT
            idmensaje,
            fecha,
            fk_idreclamo,
            fk_idusuario,
            mensaje
            FROM reclamo_mensajes ORDER BY fk_idreclamo";
        $aRetorno = DB::select($sql);
        return $aRetorno;
    }

    public function obtenerPorId($idmensaje) {
        $sql = "SELECT
            idmensaje,
            fecha,
            fk_idreclamo,
            fk_idusuario,
            mensaje
            FROM reclamo_mensajes WHERE idmensaje = $idmensaje";
        $aRetorno = DB::select($sql);
        if (count($aRetorno) > 0) {
            $this->idmensaje = $aRetorno[0]->idmensaje;
            $this->fecha = $aRetorno[0]->fecha;
            $this->fk_idreclamo = $aRetorno[0]->fk_idreclamo;
            $this->fk_idusuario = $aRetorno[0]->fk_idusuario;
            $this->mensaje = $aRetorno[0]->mensaje;
            return $this;
        }
        return null;
    }

    public function obtenerPorReclamo($idreclamo) {
        $sql = "SELECT
            A.idmensaje,
            A.fecha,
            A.fk_idreclamo,
            A.fk_idusuario,
            C.usuario,
            A.mensaje
            FROM reclamo_mensajes A
            INNER JOIN reclamos B ON A.fk_idreclamo = B.idreclamo
            INNER JOIN sistema_usuarios C ON A.fk_idusuario = C.idusuario
            WHERE A.fk_idreclamo = $idreclamo
            ORDER BY A.fecha";
        $aRetorno = DB::select($sql);
        return $aRetorno;
    }

    public function insertar() {
        $sql = "INSERT INTO reclamo_mensajes (
            fecha,
            fk_idreclamo,
            fk_idusuario,
            mensaje
            ) VALUES (?, ?, ?, ?);";
        $resultado = DB::insert($sql, [
            $this->fecha,
            $this->fk_idreclamo,
            $this->fk_idusuario,
            $this->mensaje
        ]);
        return $this->idmensaje = DB::getPdo()->lastInsertId();
    }

    public function guardar() {
        $sql = "UPDATE reclamo_mensajes SET
            fecha='$this->fecha',
            fk_idreclamo=$this->fk_idreclamo,
            fk_idusuario=$this->fk_idusuario,
            mensaje='$this->mensaje'
            WHERE idmensaje=?";
        $affected = DB::update($sql, [$this->idmensaje]);
    }

    public function eliminar() {
        $sql = "DELETE FROM reclamo_mensajes WHERE
            idmensaje=?";
        $affected = DB::delete($sql, [$this->idmensaje]);
    }

    public function eliminarPorReclamo($idreclamo) {
        $sql = "DELETE FROM reclamo_mensajes WHERE
            fk_idreclamo=$idreclamo";
        $affected = DB::delete($sql);
    }

}