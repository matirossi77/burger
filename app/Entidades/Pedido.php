<?php

namespace App\Entidades;

use DB;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    protected $table = 'pedidos';
    public $timestamps = false;

    protected $fillable = [
        'idpedido',
        'fecha',
        'descripcion',
        'total',
        'fk_idsucursal',
        'fk_idpedido',
        'fk_idestado'
    ];

    public function insertar()
    {
        $sql = "INSERT INTO $this->table (
                fecha,
                descripcion,
                total,
                fk_idsucursal,
                fk_idpedido,
                fk_idestado
            ) VALUES (?, ?, ?, ?, ?, ?);";
        $result = DB::insert($sql, [
            $this->fecha,
            $this->descripcion,
            $this->total,
            $this->fk_idsucursal,
            $this->fk_idpedido,
            $this->fk_idestado
        ]);
        return $this->idpedido = DB::getPdo()->lastInsertId();
    }

    public function guardar() {
        $sql = "UPDATE $this->table SET
            fecha=$this->fecha,
            descripcion='$this->descripcion',
            total=$this->total,
            fk_idsucursal=$this->fk_idsucursal,
            fk_idpedido=$this->fk_idpedido,
            fk_idestado=$this->fk_idestado
            WHERE idpedido=?";
        $affected = DB::update($sql, [$this->idpedido]);
    }

    public function eliminar()
    {
        $sql = "DELETE FROM $this->table WHERE
            idpedido=?";
        $affected = DB::delete($sql, [$this->idpedido]);
    }


    public function obtenerPorId($idpedido)
    {
        $sql = "SELECT
                idpedido,
                fecha,
                descripcion,
                total,
                fk_idsucursal,
                fk_idpedido,
                fk_idestado
                FROM $this->table WHERE idpedido = $idpedido";
        $lstRetorno = DB::select($sql);

        if (count($lstRetorno) > 0) {
            $this->idpedido = $lstRetorno[0]->idpedido;
            $this->fecha = $lstRetorno[0]->fecha;
            $this->descripcion = $lstRetorno[0]->descripcion;
            $this->total = $lstRetorno[0]->total;
            $this->fk_idsucursal = $lstRetorno[0]->fk_idsucursal;
            $this->fk_idpedido = $lstRetorno[0]->fk_idpedido;
            $this->fk_idestado = $lstRetorno[0]->fk_idestado;
            return $this;
        }
        return null;
    }

    public function obtenerTodos()
    {
        $sql = "SELECT
                P.idpedido,
                P.fecha,
                P.descripcion,
                P.total,
                P.fk_idsucursal,
                P.fk_idpedido,
                P.fk_idestado
                FROM $this->table P ORDER BY P.fecha";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

}
