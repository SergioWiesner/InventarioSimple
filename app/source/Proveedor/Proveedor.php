<?php

namespace App\source\Proveedor;

use App\proveedor;
use Illuminate\Support\Facades\DB;

class Proveedor
{
    private $proveedor;

    public function __construct()
    {
        $this->proveedor = new proveedor();
    }


    public function crearProveedor($data)
    {
        $this->productos->nombreproveedor = $data['nombre'];
        return $this->proveedor->save();
    }

    public function listarProveedor()
    {
        return proveedor::all();
    }

    public function actualizarProveedor($data, $id)
    {
        return DB::table('proveedor')
            ->where('id', $id)
            ->update(['nombreproveedor' => $data['nombre']]);
    }

    public function eliminarProveedor($id)
    {
        return proveedor::where('id', $id)->delete();
    }
}
