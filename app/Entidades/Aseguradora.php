<?php

namespace App\Entidades;

use DB;
use Illuminate\Database\Eloquent\Model;

class Aseguradora extends Model
{
    protected $table = 'aseguradoras';
    public $timestamps = false;

    protected $fillable = [
        'idseguradora', 'nombre', 'pagina_web', 'telefono',
    ];

    protected $hidden = [];

    public function cargarDesdeRequest($request)
    {
        $this->idaseguradora = $request->input('id') != "0" ? $request->input('id') : $this->idaseguradora;
        $this->nombre = $request->input('txtNombre');
        $this->pagina_web = $request->input('txtPaginaWeb');
        $this->telefono = $request->input('txtTelefono');
    }

    public function obtenerTodos()
    {
        $sql = "SELECT
                  A.idaseguradora,
                  A.nombre,
                  A.pagina_web,
                  A.telefono
                FROM aseguradoras A ORDER BY A.nombre";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }


    public function obtenerPorId($idaseguradora)
    {
        $sql = "SELECT
                idaseguradora,
                nombre,
                pagina_web,
                telefono
                FROM aseguradoras WHERE idaseguradora= $idaseguradora";
        $lstRetorno = DB::select($sql);

        if (count($lstRetorno) > 0) {
            $this->idaseguradora = $lstRetorno[0]->idaseguradora;
            $this->nombre = $lstRetorno[0]->nombre;
            $this->pagina_web = $lstRetorno[0]->pagina_web;
            $this->telefono = $lstRetorno[0]->telefono;
        }
        return null;
    }

    public function guardar()
    {
        $sql = "UPDATE aseguradoras SET
            nombre='$this->nombre',
            pagina_web='$this->pagina_web',
            telefono=$this->telefono
            
            WHERE idaseguradora=?";
        $affected = DB::update($sql, [$this->idaseguradora]);
    }

    public function eliminar()
    {
        $sql = "DELETE FROM aseguradoras WHERE
            idaseguradora=?";
        $affected = DB::delete($sql, [$this->idaseguradora]);
    }

    public function insertar()
    {
        $sql = "INSERT INTO aseguradoras (
                nombre,
                pagina_web,
                telefono
                
            ) VALUES (?, ?, ?);";
        $result = DB::insert($sql, [
            $this->nombre,
            $this->pagina_web,
            $this->telefono
        ]);
        return $this->idaseguradora = DB::getPdo()->lastInsertId();
    }
   
    
    
    public function obtenerFiltrado()
    {
        $request = $_REQUEST;
        $columns = array(
            0 => 'P.nombre',
            1 => 'P.pagina_web',
            2 => 'P.telefono'
        );
        $sql = "SELECT DISTINCT
                    P.idaseguradora,
                    P.nombre,
                    P.pagina_web,
                    P.telefono
                    FROM aseguradoras P
                WHERE 1=1
                ";

        //Realiza el filtrado
        if (!empty($request['search']['value'])) {
            $sql .= " AND ( P.nombre LIKE '%" . $request['search']['value'] . "%'";
            $sql .= " OR P.nombre LIKE '%" . $request['search']['value'] . "%'";
            $sql .= " OR P.pagina_web LIKE '%" . $request['search']['value'] . "%'";
            $sql .= " OR P.telefono LIKE '%" . $request['search']['value'] . "%')";
        }
        $sql .= " ORDER BY " . $columns[$request['order'][0]['column']] . "   " . $request['order'][0]['dir'];

        $lstRetorno = DB::select($sql);

        return $lstRetorno;
    }

}

