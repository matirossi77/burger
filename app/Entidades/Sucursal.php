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

}
