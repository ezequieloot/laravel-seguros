<?php

namespace App\Entidades;

use DB;
use Illuminate\Database\Eloquent\Model;

class Seguro extends Model
{
    protected $table = 'seguros';
    public $timestamps = false;

    protected $fillable = [
        'idseguro', 'nombre', 'fk_idaseguradora', 'descripcion', 'fk_idtiposeguro', 'icono'
    ];

    protected $hidden = [];

    public function cargarDesdeRequest($request)
    {
        $this->idseguro = $request->input('id') != "0" ? $request->input('id') : $this->idseguro;
        $this->nombre = $request->input('txtNombre');
        $this->descripcion = $request->input('txtDescripcion');
        $this->fk_idtiposeguro = $request->input('lstTipoSeguro');
        $this->icono = $request->input('txtIcono');
    }

    public function obtenerTodos() {
        $sql = "SELECT
                    A.idseguro,
                    A.icono,
                    A.nombre,
                    A.descripcion,
                    A.fk_idtiposeguro,
                    A.icono,
                    C.nombre as tipo
                FROM seguros A
                LEFT JOIN tipo_seguros C ON A.fk_idtiposeguro = C.idtiposeguro
                ORDER BY A.nombre";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

    public function obtenerPorId($idseguro)
    {
        $sql = "SELECT
                    A.idseguro,
                    A.nombre,
                    A.descripcion,
                    A.fk_idtiposeguro,
                    A.icono
                FROM seguros A
                WHERE A.idseguro = $idseguro";
        $lstRetorno = DB::select($sql);

        if (count($lstRetorno) > 0) {
            $this->idseguro = $lstRetorno[0]->idseguro;
            $this->nombre = $lstRetorno[0]->nombre;
            $this->descripcion = $lstRetorno[0]->descripcion;
            $this->fk_idtiposeguro = $lstRetorno[0]->fk_idtiposeguro;
            $this->icono = $lstRetorno[0]->icono;
            return $this;
        }
        return null;
    }

    public function guardar()
    {
        $sql = "UPDATE seguros SET
            nombre='$this->nombre',
            descripcion='$this->descripcion',
            fk_idtiposeguro=$this->fk_idtiposeguro,
            icono='$this->icono'
            WHERE idseguro=?";
        $affected = DB::update($sql, [$this->idseguro]);
    }

    public function eliminar()
    {
        $sql = "DELETE FROM seguros WHERE idseguro=?";
        $affected = DB::delete($sql, [$this->idseguro]);
    }

    public function insertar()
    {
        $sql = "INSERT INTO seguros (
                nombre,
                descripcion,
                fk_idtiposeguro,
                icono
            ) VALUES (?, ?, ?, ?, ?);";
        $result = DB::insert($sql, [
            $this->nombre,
            $this->descripcion,
            $this->fk_idtiposeguro,
            $this->icono
        ]);
        return $this->idseguro = DB::getPdo()->lastInsertId();
    }
    public function obtenerFiltrado()
    {
        $request = $_REQUEST;
        $columns = array(
            0 => 'P.nombre',
            1 => 'P.descripcion',
            2 => 'P.fk_idtiposeguro',
            3 => 'P.icono'
        );
        $sql = "SELECT DISTINCT  
                    P.idseguro,
                    P.nombre,
                    P.descripcion,
                    P.fk_idtiposeguro,
                    P.icono,
                    B.nombre as tipo
                    FROM seguros P
                    INNER JOIN tipo_seguros B ON P.fk_idtiposeguro = B.idtiposeguro

                WHERE 1=1
                ";

        //Realiza el filtrado
        if (!empty($request['search']['value'])) {
            $sql .= " AND ( P.nombre LIKE '%" . $request['search']['value'] . "%'";
            $sql .= " OR P.nombre LIKE '%" . $request['search']['value'] . "%'";
            $sql .= " OR P.descripcion LIKE '%" . $request['search']['value'] . "%')";
            $sql .= " OR P.fk_dtiposeguro LIKE '%" . $request['search']['value'] . "%')";
        }
        $sql .= " ORDER BY " . $columns[$request['order'][0]['column']] . "   " . $request['order'][0]['dir'];

        $lstRetorno = DB::select($sql);

        return $lstRetorno;
    }

}
