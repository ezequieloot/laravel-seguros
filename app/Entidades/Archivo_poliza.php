<?php

namespace App\Entidades;

use DB;
use Illuminate\Database\Eloquent\Model;

class Archivo_poliza extends Model
{
    protected $table = 'archivo_polizas';
    public $timestamps = false;

    protected $fillable = [
        'idarchivo', 'nombre', 
    ];

    protected $hidden = [

        ];

    public function cargarDesdeRequest($request)
    {
        $this->idarchivo = $request->input('id') != "0" ? $request->input('id') : $this->idarchivo;
        $this->nombre = $request->input('txtNombre');
       
    }

    public function obtenerFiltrado() {
        $request = $_REQUEST;
        $columns = array(
            0 => 'A.nombre'
        );
        $sql = "SELECT 
                A.idarchivo,
                A.nombre
                FROM sistema_usuarios A
                WHERE 1=1";

        //Realiza el filtrado
        if (!empty($request['search']['value'])) { 
            $sql.=" AND ( A.nombre LIKE '%" . $request['search']['value'] . "%' ";
        }
        $sql.=" ORDER BY " . $columns[$request['order'][0]['column']] . "   " . $request['order'][0]['dir'];

        $lstRetorno = DB::select($sql);

        return $lstRetorno;
    }

    public function obtenerTodos()
    {
        $sql = "SELECT
                  A.idarchivo,
                  A.nombre
                FROM archivo_polizas A ORDER BY A.nombre";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }


    public function obtenerPorId($idarchivo)
    {
        $sql = "SELECT
                idarchivo,
                nombre
              
                FROM archivo_polizas WHERE idarchivo = $idarchivo";
        $lstRetorno = DB::select($sql);

        if (count($lstRetorno) > 0) {
            $this->idarchivo = $lstRetorno[0]->idarchivo;
            $this->nombre = $lstRetorno[0]->nombre;
            return $this;
        }
        return null;
    }

    public function guardar()
    {
        $sql = "UPDATE archivo_polizas SET
            nombre='$this->nombre'
            WHERE idarchivo=?";
        $affected = DB::update($sql, [$this->idarchivo]);
    }

    public function eliminar()
    {
        $sql = "DELETE FROM archivo_polizas WHERE
            idarchivo=?";
        $affected = DB::delete($sql, [$this->idarchivo]);
    }

    public function insertar()
    {
        $sql = "INSERT INTO archivo_polizas (
                nombre
                
            ) VALUES (?);";
        $result = DB::insert($sql, [
            $this->nombre
        ]);
        return $this->idarchivo = DB::getPdo()->lastInsertId();
    }

}
