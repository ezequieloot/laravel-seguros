<?php

namespace App\Entidades;

use DB;
use Illuminate\Database\Eloquent\Model;

class Archivo extends Model
{
    protected $table = 'archivos';
    public $timestamps = false;

    protected $fillable = [
        'idarchivo', 'ubicacion', 'nombre', 'fk_idmensaje',
    ];

    protected $hidden = [

    ];

    public function obtenerTodos()
    {
        $sql = "SELECT
                  A.idarchivo,
                  A.ubicacion,
                  A.nombre,
                  A.fk_idmensaje
                FROM archivos A ORDER BY A.nombre";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }


    public function obtenerPorId($idarchivo)
    {
        $sql = "SELECT
                idarchivo,
                ubicacion,
                nombre,
                fk_idmensaje
                FROM archivos WHERE idarchivo = $idarchivo";
        $lstRetorno = DB::select($sql);

        if (count($lstRetorno) > 0) {
            $this->idarchivo = $lstRetorno[0]->idarchivo;
            $this->ubicacion = $lstRetorno[0]->ubicacion;
            $this->nombre = $lstRetorno[0]->nombre;
            $this->fk_idmensaje = $lstRetorno[0]->fk_idmensaje;
            return $this;
        }
        return null;
    }

    public function guardar()
    {
        $sql = "UPDATE archivos SET
            idarchivo='$this->idarchivo',
            ubicacion='$this->ubicacion',
            nombre='$this->nombre',
            fk_idmensaje=$this->fk_idmensaje
            WHERE idarchivo=?";
        $affected = DB::update($sql, [$this->idarchivo]);
    }

    public function eliminar()
    {
        $sql = "DELETE FROM archivos WHERE
            idarchivo=?";
        $affected = DB::delete($sql, [$this->idarchivo]);
    }

    public function insertar()
    {
        $sql = "INSERT INTO archivos (
                idarchivo,
                ubicacion,
                nombre,
                fk_idmensaje
            ) VALUES (?, ?, ?, ?);";
        $result = DB::insert($sql, [
            $this->idarchivo,
            $this->ubicacion,
            $this->nombre,
            $this->fk_idmensaje
        ]);
        return $this->idarchivo = DB::getPdo()->lastInsertId();
    }

}
