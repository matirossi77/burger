<?php

namespace App\Entidades;

use DB;
use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    protected $table = 'sucursales';
    public $timestamps = false;

    protected $fillable = [
        'idsucursal',
        'telefono',
        'direccion',
        'linkmaps'
    ];

    public function insertar()
    {
        $sql = "INSERT INTO $this->table (
                telefono,
                direccion,
                linkmaps
            ) VALUES (?, ?, ?);";
        $result = DB::insert($sql, [
            $this->telefono,
            $this->direccion,
            $this->linkmaps
        ]);
        return $this->idsucursal = DB::getPdo()->lastInsertId();
    }

    public function guardar() {
        $sql = "UPDATE $this->table SET
            telefono='$this->telefono',
            direccion='$this->direccion',
            linkmaps='$this->linkmaps'
            WHERE idsucursal=?";
        $affected = DB::update($sql, [$this->idsucursal]);
    }

    public function eliminar()
    {
        $sql = "DELETE FROM $this->table WHERE
            idsucursal=?";
        $affected = DB::delete($sql, [$this->idsucursal]);
    }


    public function obtenerPorId($idsucursal)
    {
        $sql = "SELECT
                idsucursal,
                telefono,
                direccion,
                linkmaps
                FROM $this->table WHERE idsucursal = $idsucursal";
        $lstRetorno = DB::select($sql);

        if (count($lstRetorno) > 0) {
            $this->idsucursal = $lstRetorno[0]->idsucursal;
            $this->telefono = $lstRetorno[0]->telefono;
            $this->direccion = $lstRetorno[0]->direccion;
            $this->linkmaps = $lstRetorno[0]->linkmaps;
            return $this;
        }
        return null;
    }

    public function obtenerTodos()
    {
        $sql = "SELECT
                S.idsucursal,
                S.telefono,
                S.direccion,
                S.linkmaps
                FROM $this->table S ORDER BY S.nombre";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

}
