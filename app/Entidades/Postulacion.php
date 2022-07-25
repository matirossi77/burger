<?php

namespace App\Entidades;

use DB;
use Illuminate\Database\Eloquent\Model;

class Postulacion extends Model
{
    protected $table = 'postulaciones';
    public $timestamps = false;

    protected $fillable = [
        'idpostulacion','nombre','apellido','celular','correo','curriculum'
    ];

    public function insertar()
    {
        $sql = "INSERT INTO $this->table (
                nombre,
                apellido,
                celular,
                correo,
                curriculum
            ) VALUES (?, ?, ?, ?, ?);";
        $result = DB::insert($sql, [
            $this->nombre,
            $this->apellido,
            $this->celular,
            $this->correo,
            $this->curriculum
        ]);
        return $this->idpostulacion = DB::getPdo()->lastInsertId();
    }

}
