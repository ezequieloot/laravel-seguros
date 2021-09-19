<?php

namespace App\Entidades;

use DB;
use Illuminate\Database\Eloquent\Model;

class Poliza extends Model
{
    protected $table = 'polizas';
    public $timestamps = false;

    protected $fillable = [
        'idpoliza', 'fecha_emision', 'fk_idcliente', ' numero_poliza', 'domicilio_riesgo', 'riesgo', 'bien', 'fk_idaseguradora', 'fk_idseguro', 'fecha_inicio', 'fecha_fin', 'suma_asegurada', 'endoso', 'observaciones'
    ];

    protected $hidden = [];

    public function cargarDesdeRequest($request)
    {
        $this->idpoliza = $request->input('id') != "0" ? $request->input('id') : $this->idpoliza;
        $this->fecha_emision = $request->input('txtFecha');
        $this->fk_idcliente = $request->input('lstCliente');
        $this->numero_poliza = $request->input('txtPoliza');
        $this->domicilio_riesgo = $request->input('txtDomicilioRiesgo');
        $this->riesgo = $request->input('txtRiesgo');
        $this->bien = $request->input('txtBien');
        $this->fk_idaseguradora = $request->input('lstAseguradora');
        $this->fk_idseguro = $request->input('lstSeguro');
        $this->fecha_inicio = $request->input('txtFechaInicio');
        $this->fecha_fin = $request->input('txtFechaFin');
        $this->suma_asegurada = $request->input('txtSumaAsegurada');
        $this->endoso = $request->input('txtEndoso');
        $this->observaciones = $request->input('txtObservaciones');
    }

    public function obtenerFiltrado()
    {
        $request = $_REQUEST;
        $columns = array(

            0 => 'A.numero_poliza',
            1 => 'B.nombre',
            2 => 'A.fecha_emision',
            3 => 'A.bien',
            4 => 'A.riesgo',
            5 => 'D.nombre',
            6 => 'A.fecha_inicio',
            7 => 'A.fecha_fin',
            8 => 'A.endoso'
           
        );
        $sql = "SELECT DISTINCT
                    A.idpoliza,
                    A.numero_poliza,
                    B.nombre as cliente,
                    A.fecha_emision,
                    A.bien,
                    A.riesgo,
                    D.nombre as seguro,
                    A.fecha_inicio,
                    A.fecha_fin,
                    A.endoso
                    FROM polizas A
                    LEFT JOIN clientes B ON A.fk_idcliente = B.idcliente
                    LEFT JOIN aseguradoras C ON A.fk_idaseguradora = C.idaseguradora
                    LEFT JOIN seguros D ON A.fk_idseguro = D.idseguro
                WHERE 1=1
                ";

        //Realiza el filtrado
        if (!empty($request['search']['value'])) {
            $sql .= " AND ( A.numero_poliza LIKE '%" . $request['search']['value'] . "%'";
            $sql .= " OR B.nombre LIKE '%" . $request['search']['value'] . "%'";
            $sql .= " OR A.fecha_emision LIKE '%" . $request['search']['value'] . "%'";
            $sql .= " OR A.bien LIKE '%" . $request['search']['value'] . "%'";
            $sql .= " OR A.riesgo LIKE '%" . $request['search']['value'] . "%'";
            $sql .= " OR D.nombre LIKE '%" . $request['search']['value'] . "%'";
            $sql .= " OR A.fecha_inicio LIKE '%" . $request['search']['value'] . "%'";
            $sql .= " OR A.fecha_fin LIKE '%" . $request['search']['value'] . "%'";
            $sql .= " OR A.endoso LIKE '%" . $request['search']['value'] . "%')";

        }
        $sql .= " ORDER BY " . $columns[$request['order'][0]['column']] . "   " . $request['order'][0]['dir'];

        $lstRetorno = DB::select($sql);

        return $lstRetorno;
    }
    
    public function obtenerSegurosPorCliente($id){
        $sql="SELECT DISTINCT 
                A.fk_idseguro,
                B.nombre,
                B.icono
                FROM polizas A
                INNER JOIN seguros B ON A.fk_idseguro = B.idseguro
                WHERE A.fk_idcliente = '$id'";
            $lstRetorno = DB::select($sql);
            return $lstRetorno;
    }
    public function obtenerPolizaPorSeguro($idseguro, $idcliente){
        $sql="SELECT 
                A.idpoliza,
                A.numero_poliza,
                A.bien,
                A.fecha_emision,
                A.fecha_fin,
                A.fk_idseguro,
                A.fk_idcliente,
                B.nombre as seguro,
                C.nombre as aseguradora
                FROM polizas A
                INNER JOIN seguros B ON A.fk_idseguro = B.idseguro
                INNER JOIN aseguradoras C ON A.fk_idaseguradora = C.idaseguradora
                WHERE A.fk_idseguro = '$idseguro' AND fk_idcliente = '$idcliente'";
            $lstRetorno = DB::select($sql);
            return $lstRetorno;
    }

    public function obtenerTodos()
    {
        $sql = "SELECT
                  A.idpoliza,
                  A.fecha_emision,
                  A.fk_idcliente,
                  A.numero_poliza,
                  A.domicilio_riesgo,
                  A.riesgo,
                  A.bien,
                  A.fecha_inicio,
                  A.fecha_fin,
                  A.suma_asegurada,
                  A.endoso,
                  A.observaciones,
                  B.nombre as cliente,
                  C.nombre as asegurdora,
                  D.nombre as seguro
                FROM polizas A
                LEFT JOIN clientes B ON A.fk_idcliente = B.idcliente
                LEFT JOIN aseguradoras C ON A.fk_idaseguradora = C.idaseguradora
                LEFT JOIN seguros D ON A.fk_idseguro = D.idseguro
                ORDER BY A.idpoliza";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }


    public function obtenerPorId($idPoliza)
    {
        $sql = "SELECT
                idpoliza,
                fecha_emision,
                fk_idcliente,
                numero_poliza,
                domicilio_riesgo,
                riesgo,
                bien,
                fecha_inicio,
                fecha_fin,
                suma_asegurada,
                endoso,
                observaciones,
                fk_idaseguradora,
                fk_idseguro
                FROM polizas WHERE idpoliza = $idPoliza";
        $lstRetorno = DB::select($sql);

        if (count($lstRetorno) > 0) {
            $this->idpoliza = $lstRetorno[0]->idpoliza;
            $this->fecha_emision = $lstRetorno[0]->fecha_emision;
            $this->fk_idcliente = $lstRetorno[0]->fk_idcliente;
            $this->numero_poliza = $lstRetorno[0]->numero_poliza;
            $this->domicilio_riesgo = $lstRetorno[0]->domicilio_riesgo;
            $this->riesgo = $lstRetorno[0]->riesgo;
            $this->bien = $lstRetorno[0]->bien;
            $this->fecha_inicio = $lstRetorno[0]->fecha_inicio;
            $this->fecha_fin = $lstRetorno[0]->fecha_fin;
            $this->suma_asegurada = $lstRetorno[0]->suma_asegurada;
            $this->endoso = $lstRetorno[0]->endoso;
            $this->observaciones = $lstRetorno[0]->observaciones;
            $this->fk_idaseguradora = $lstRetorno[0]->fk_idaseguradora;
            $this->fk_idseguro = $lstRetorno[0]->fk_idseguro;
            return $this;
        }
        return null;
    }

    public function guardar() {
        $sql = "UPDATE polizas SET
            fecha_emision='$this->fecha_emision',
            fk_idcliente=$this->fk_idcliente,
            numero_poliza='$this->numero_poliza',
            riesgo='$this->riesgo',
            bien='$this->bien',
            domicilio_riesgo='$this->domicilio_riesgo',
            fecha_inicio='$this->fecha_inicio',
            fecha_fin='$this->fecha_fin',
            suma_asegurada='$this->suma_asegurada',
            endoso='$this->endoso',
            observaciones='$this->observaciones',
            fk_idaseguradora='$this->fk_idaseguradora',
            fk_idseguro='$this->fk_idseguro'
            WHERE idpoliza=?";
        $affected = DB::update($sql, [$this->idpoliza]);
    }

    public function eliminar()
    {
        $sql = "DELETE FROM polizas WHERE
            idpoliza=?";
        $affected = DB::delete($sql, [$this->idpoliza]);
    }

    public function insertar()
    {
        $sql = "INSERT INTO polizas (
                fecha_emision,
                fk_idcliente,
                numero_poliza,
                domicilio_riesgo,
                riesgo,
                bien,
                fecha_inicio,
                fecha_fin,
                suma_asegurada,
                endoso,
                observaciones,
                fk_idaseguradora,
                fk_idseguro
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
        $result = DB::insert($sql, [
            $this->fecha_emision,
            $this->fk_idcliente,
            $this->numero_poliza,
            $this->domicilio_riesgo,
            $this->riesgo,
            $this->bien,
            $this->fecha_inicio,
            $this->fecha_fin,
            $this->suma_asegurada,
            $this->endoso,
            $this->observaciones,
            $this->fk_idaseguradora,
            $this->fk_idseguro
        ]);
        return $this->idpoliza = DB::getPdo()->lastInsertId();
    }
}
