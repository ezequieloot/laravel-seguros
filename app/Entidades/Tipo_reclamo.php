<?php

namespace App\Entidades;

use DB;
use Illuminate\Database\Eloquent\Model;

class Tipo_reclamo extends Model
{
    protected $table = 'tipo_reclamos';
    public $timestamps = false;

    protected $fillable = [
        'idtiporeclamo', 'nombre'
    ];

    protected $hidden = [

    ];

    public function cargarDesdeRequest($request)
    {
        $this->idtiporeclamo = $request->input('id') != "0" ? $request->input('id') : $this->idtiporeclamo;
        $this->nombre = $request->input('txtNombre');
       
    }

    public function obtenerTodos() {
        $sql = "SELECT
                  A.idtiporeclamo,
                  A.nombre
                FROM tipo_reclamos A ORDER BY A.nombre";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }


    public function obtenerPorId($idtiporeclamo)
    {
        $sql = "SELECT
                idtiporeclamo,
                nombre
                FROM tipo_reclamos WHERE idtiporeclamo = $idtiporeclamo";
        $lstRetorno = DB::select($sql);

        if (count($lstRetorno) > 0) {
            $this->idtiporeclamo = $lstRetorno[0]->idtiporeclamo;
            $this->nombre = $lstRetorno[0]->nombre;
            return $this;
        }
        return null;
    }

    public function guardar()
    {
        $sql = "UPDATE tipo_reclamos SET
            nombre='$this->nombre'
            WHERE idtiporeclamo=?";
        $affected = DB::update($sql, [$this->idtiporeclamo]);
    }

    public function eliminar()
    {
        $sql = "DELETE FROM reclamos WHERE
            idtiporeclamo=?";
        $affected = DB::delete($sql, [$this->idtiporeclamo]);
    }

    public function insertar()
    {
        $sql = "INSERT INTO reclamos (
                nombre
            ) VALUES (?);";
        $result = DB::insert($sql, [
            $this->nombre,
        ]);
        return $this->idtiporeclamo = DB::getPdo()->lastInsertId();
    }

}
