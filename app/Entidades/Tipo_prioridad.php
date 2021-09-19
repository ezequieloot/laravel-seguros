<?php

namespace App\Entidades;

use DB;
use Illuminate\Database\Eloquent\Model;

class Tipo_prioridad extends Model
{
    protected $table = 'tipo_prioridades';
    public $timestamps = false;

    protected $fillable = [
        'idtipo_prioridad', 'nombre'
    ];

    protected $hidden = [

        ];

    public function cargarDesdeRequest($request)
    {
        $this->idtipo_prioridad = $request->input('id') != "0" ? $request->input('id') : $this->idtipo_prioridad;
        $this->nombre = $request->input('txtNombre');
       
    }

    public function obtenerTodos()
    {
        $sql = "SELECT
                  A.idtipo_prioridad,
                  A.nombre
                FROM tipo_prioridades A ORDER BY A.nombre";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }


    public function obtenerPorId($idtipo_prioridad)
    {
        $sql = "SELECT
                idtipo_prioridad,
                nombre
                FROM tipo_prioridades WHERE idtipo_prioridad = $idtipo_prioridad";
        $lstRetorno = DB::select($sql);

        if (count($lstRetorno) > 0) {
            $this->idtipo_prioridad = $lstRetorno[0]->idtipo_prioridad;
            $this->nombre = $lstRetorno[0]->nombre;
            return $this;
        }
        return null;
    }


    public function guardar()
    {
        $sql = "UPDATE tipo_prioridades SET
            nombre='$this->nombre'
            WHERE idtipo_prioridad=?";
        $affected = DB::update($sql, [$this->idarchivo]);
    }

    public function eliminar()
    {
        $sql = "DELETE FROM tipo_prioridades WHERE
            idtipo_prioridad=?";
        $affected = DB::delete($sql, [$this->idtipo_prioridad]);
    }

    public function insertar()
    {
        $sql = "INSERT INTO tipop_prioridades (
                nombre
                
            ) VALUES (?);";
        $result = DB::insert($sql, [
            $this->nombre,
        ]);
        return $this->idtipo_prioridad = DB::getPdo()->lastInsertId();
    }

}
