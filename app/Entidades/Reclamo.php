<?php

namespace App\Entidades;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;

class Reclamo extends Model
{
    protected $table = 'reclamos';
    public $timestamps = false;

    protected $fillable = [
        'idreclamo', 'codigo', 'fecha', 'fk_idestado', 'fk_idtipo_prioridad', 'fk_idtipo_reclamo', 'fk_idseguro', 'fk_idusuario', 'descripcion'
    ];

    protected $hidden = [

    ];

    public function cargarDesdeRequest($request) {
        $this->idreclamo = $request->input('id') != "0" ? $request->input('id') : $this->idreclamo;
        $this->codigo = $request->input("txtCodigo");
        $this->fecha = $request->input("anio") . "-" .  $request->input("mes") . "-" .  $request->input("dia");
        $this->fk_idestado = $request->input("estado");
        $this->fk_idtipo_prioridad = $request->input("prioridad");
        $this->fk_idtipo_reclamo = $request->input("tipo");
        $this->fk_idseguro = $request->input("seguro");
        $this->fk_idusuario = Session::get("usuario_id");
        $this->descripcion = $request->input("txtDescripcion");
    }

    public function obtenerTodos() {
        $sql = "SELECT
                A.idreclamo,
                A.codigo,
                A.fecha,
                A.fk_idestado, 
                A.fk_idtipo_prioridad,
                A.fk_idtipo_reclamo,
                A.fk_idseguro,
                A.fk_idusuario,
                A.descripcion 
                FROM reclamos A ORDER BY A.idreclamo";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

    public function obtenerPorUsuario($idUsuario) {
        $sql = "SELECT
                A.idreclamo,
                A.codigo,
                A.fecha,
                A.fk_idestado,
                B.nombre AS estado, 
                A.fk_idtipo_prioridad,
                A.fk_idtipo_reclamo,
                C.nombre AS tipo,
                A.fk_idseguro,
                D.nombre AS seguro,
                A.fk_idusuario,
                A.descripcion 
                FROM reclamos A
                INNER JOIN reclamo_estados B ON A.fk_idestado = B.idestado
                INNER JOIN tipo_reclamos C ON A.fk_idtipo_reclamo = C.idtiporeclamo
                INNER JOIN seguros D ON A.fk_idseguro = D.idseguro
                WHERE A.fk_idusuario = $idUsuario
                ORDER BY A.idreclamo";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

    public function obtenerPorId($idReclamo) {
        $sql = "SELECT
                A.idreclamo,
                A.codigo,
                A.fecha,
                A.fk_idestado,
                B.nombre AS estado,
                A.fk_idtipo_prioridad,
                C.nombre AS prioridad,
                A.fk_idtipo_reclamo,
                D.nombre AS tipo,
                A.fk_idseguro,
                E.nombre AS seguro,
                A.fk_idusuario,
                F.usuario,
                A.descripcion
                FROM reclamos A
                INNER JOIN reclamo_estados B ON A.fk_idestado = B.idestado
                INNER JOIN tipo_prioridades C ON A.fk_idtipo_prioridad = C.idtipo_prioridad
                INNER JOIN tipo_reclamos D ON A.fk_idtipo_reclamo = D.idtiporeclamo
                INNER JOIN seguros E ON A.fk_idseguro = E.idseguro
                INNER JOIN sistema_usuarios F ON A.fk_idusuario = F.idusuario
                WHERE A.idreclamo = $idReclamo";
        $lstRetorno = DB::select($sql);

        if (count($lstRetorno) > 0) {
            $this->idreclamo = $lstRetorno[0]->idreclamo;
            $this->codigo = $lstRetorno[0]->codigo;
            $this->fecha = $lstRetorno[0]->fecha;
            $this->fk_idestado = $lstRetorno[0]->fk_idestado;
            $this->estado = $lstRetorno[0]->estado;
            $this->fk_idtipo_prioridad = $lstRetorno[0]->fk_idtipo_prioridad;
            $this->prioridad = $lstRetorno[0]->prioridad;
            $this->fk_idtipo_reclamo = $lstRetorno[0]->fk_idtipo_reclamo;
            $this->tipo = $lstRetorno[0]->tipo;
            $this->fk_idseguro = $lstRetorno[0]->fk_idseguro;
            $this->seguro = $lstRetorno[0]->seguro;
            $this->fk_idusuario = $lstRetorno[0]->fk_idusuario;
            $this->usuario = $lstRetorno[0]->usuario;
            $this->descripcion = $lstRetorno[0]->descripcion;
            return $this;
        }
        return null;
    }

    public function insertar() {
        $sql = "INSERT INTO reclamos (
                codigo,
                fecha,
                fk_idestado, 
                fk_idtipo_prioridad,
                fk_idtipo_reclamo,
                fk_idseguro,
                fk_idusuario,
                descripcion
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?);";

        $result = DB::insert($sql, [
            $this->codigo,
            $this->fecha,
            $this->fk_idestado,
            $this->fk_idtipo_prioridad,
            $this->fk_idtipo_reclamo,
            $this->fk_idseguro,
            $this->fk_idusuario,
            $this->descripcion
        ]);
        return $this->idreclamo = DB::getPdo()->lastInsertId();
    }

    public function guardar() {
        $sql = "UPDATE reclamos SET
            idreclamo=$this->idreclamo,
            codigo='$this->codigo',
            fecha='$this->fecha',
            fk_idestado=$this->fk_idestado,
            fk_idtipo_prioridad=$this->fk_idtipo_prioridad,
            fk_idtipo_reclamo=$this->fk_idtipo_reclamo,
            fk_idseguro=$this->fk_idseguro,
            descripcion='$this->descripcion'
            WHERE idreclamo=?";
        $affected = DB::update($sql, [$this->idreclamo]);
    }

    public function eliminar() {
        $sql = "DELETE FROM reclamos WHERE
            idreclamo=?";
        $affected = DB::delete($sql, [$this->idreclamo]);
    }

    public function obtenerFiltrado()
    {
        $request = $_REQUEST;
        $columns = array(
            0 => 'A.codigo',
            1 => 'A.fecha',
            2 => 'A.fk_idestado',
            3 => 'A.fk_idtipo_prioridad',
            4 => 'A.fk_idtipo_reclamo',
            5 => 'A.fk_idseguro',
            6 => 'A.fk_idusuario',
            7 => 'A.descripcion'
        );
        $sql = "SELECT DISTINCT
                    A.idreclamo,
                    A.codigo,
                    A.fecha,
                    B.nombre as estado,
                    C.nombre as tipoprioridad,
                    D.nombre as reclamo,
                    E.nombre as seguro, 
                    F.nombre as usuario,
                    A.descripcion
                    FROM reclamos A
                    INNER JOIN reclamo_estados B ON A.fk_idestado = B.idestado
                    INNER JOIN tipo_prioridades C ON A.fk_idtipo_prioridad = C.idtipo_prioridad
                    INNER JOIN tipo_reclamos D ON A.fk_idtipo_reclamo = D.idtiporeclamo
                    INNER JOIN seguros E ON A.fk_idseguro = E.idseguro
                    INNER JOIN sistema_usuarios F ON A.fk_idusuario = F.idusuario
                WHERE 1=1
                ";

        //Realiza el filtrado
        if (!empty($request['search']['value'])) {
            $sql .= " AND ( A.codigo LIKE '%" . $request['search']['value'] . "%'";
            $sql .= " OR A.fecha LIKE '%" . $request['search']['value'] . "%'";
            $sql .= " OR B.nombre LIKE '%" . $request['search']['value'] . "%'";
            $sql .= " OR C.nombre LIKE '%" . $request['search']['value'] . "%'";
            $sql .= " OR D.nombre LIKE '%" . $request['search']['value'] . "%'";
            $sql .= " OR E.nombre LIKE '%" . $request['search']['value'] . "%'";
            $sql .= " OR F.nombre LIKE '%" . $request['search']['value'] . "%'";
            $sql .= " OR A.descripcion LIKE '%" . $request['search']['value'] . "%')";
        }
        $sql .= " ORDER BY " . $columns[$request['order'][0]['column']] . "   " . $request['order'][0]['dir'];

        $lstRetorno = DB::select($sql);

        return $lstRetorno;
    }

}
