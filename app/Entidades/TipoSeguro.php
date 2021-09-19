<?php

namespace App\Entidades;

use DB;
use Illuminate\Database\Eloquent\Model;

class TipoSeguro extends Model
{
    protected $table = 'tipo_seguros';
    public $timestamps = false;

    protected $fillable = [
        'idtiposeguro', 'nombre'
    ];

    protected $hidden = [];

    public function cargarDesdeRequest($request)
    {
        $this->idtiposeguro = $request->input('id') != "0" ? $request->input('id') : $this->idtiposeguro;
        $this->nombre = $request->input('txtNombre');
    }

    public function obtenerTodos()
    {
        $sql = "SELECT
                  A.idtiposeguro,
                  A.nombre
                FROM tipo_seguros A ORDER BY A.nombre";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }


    public function obtenerPorId($idtiposeguro)
    {
        $sql = "SELECT
                idtiposeguro,
                nombre
                FROM tipo_seguros WHERE idtiposeguro = $idtiposeguro";
        $lstRetorno = DB::select($sql);

        if (count($lstRetorno) > 0) {
            $this->idtiposeguro = $lstRetorno[0]->idtiposeguro;
            $this->nombre = $lstRetorno[0]->nombre;
            return $this;
        }
        return null;
    }

    public function guardar()
    {
        $sql = "UPDATE tipo_seguros SET
            nombre='$this->nombre'
            WHERE idtiposeguro=?";
        $affected = DB::update($sql, [$this->idtiposeguro]);
    }

    public function eliminar()
    {
        $sql = "DELETE FROM tipo_seguros WHERE
            idtiposeguro=?";
        $affected = DB::delete($sql, [$this->idtiposeguro]);
    }

    public function insertar()
    {
        $sql = "INSERT INTO tipo_seguros (
                nombre
            ) VALUES (?);";
        $result = DB::insert($sql, [
            $this->nombre
        ]);
        return $this->idtiposeguro = DB::getPdo()->lastInsertId();
    }
}
