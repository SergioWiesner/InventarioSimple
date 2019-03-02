<?php

namespace App\source\Proveedor;

use App\proveedor as database;
use App\source\Tools\Basics;
use Illuminate\Support\Facades\DB;

class Proveedor
{
    private $proveedor;

    public function __construct()
    {
        $this->proveedor = new database();
    }


    public function crearProveedor($data)
    {
        $this->proveedor->nombreproveedor = $data['nombreproveedor'];
        return $this->proveedor->save();
    }

    public function listarProveedor()
    {
        return Basics::collectionToArray(database::all());
    }

    public function actualizarProveedor($data, $id)
    {
        return DB::table('proveedor')
            ->where('id', $id)
            ->update(['nombreproveedor' => $data['nombre']]);
    }

    public function eliminarProveedor($id)
    {
        return database::where('id', $id)->delete();
    }
}
