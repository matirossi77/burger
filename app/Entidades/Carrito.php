<?php

namespace App\Entidades;

use DB;
use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
    protected $table = 'carritos';
    public $timestamps = false;

    protected $fillable = [
        'idcarrito',
        'fk_idcliente'
    ];

    public function insertar()
    {
        $sql = "INSERT INTO $this->table (
                fk_idcliente
            ) VALUES (?);";
        $result = DB::insert($sql, [
            $this->fk_idcliente
        ]);
        return $this->idcarrito = DB::getPdo()->lastInsertId();
    }

    public function guardar() {
        $sql = "UPDATE $this->table SET
            fk_idcliente=$this->fk_idcliente
            WHERE idcarrito=?";
        $affected = DB::update($sql, [$this->idcarrito]);
    }

    public function eliminar()
    {
        $sql = "DELETE FROM $this->table WHERE
            idcarrito=?";
        $affected = DB::delete($sql, [$this->idcarrito]);
    }


    public function obtenerPorId($idcarrito)
    {
        $sql = "SELECT
                idcarrito,
                fk_idcliente
                FROM $this->table WHERE idcarrito = $idcarrito";
        $lstRetorno = DB::select($sql);

        if (count($lstRetorno) > 0) {
            $this->idcarrito = $lstRetorno[0]->idcarrito;
            $this->fk_idcliente = $lstRetorno[0]->fk_idcliente;
            return $this;
        }
        return null;
    }

    public function obtenerTodos()
    {
        $sql = "SELECT
                C.idcarrito,
                C.fk_idcliente
                FROM $this->table C ORDER BY C.fk_idcliente";
        $lstRetorno = DB::select($sql);
        return $lstRetorno;
    }

}
