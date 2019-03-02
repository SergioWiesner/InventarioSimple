<?php

namespace App\source\Ventas;

use App\ventas;
use Illuminate\Support\Facades\DB;


class Ventas
{
    private $ventas;

    public function __construct()
    {
        $this->ventas = new ventas();
    }

    public function crearUsuarios($data)
    {
        $this->ventas->idproductos = $data['idproductos'];
        $this->ventas->idusuarios = $data['idusuarios'];
        $this->ventas->cantidad = $data['cantidad'];
        return $this->ventas->save();
    }

    public function listarUsuarios()
    {
        return ventas::all();
    }

    public function actualizarUsuarios($data, $id)
    {
        return DB::table('ventas')
            ->where('id', $id)
            ->update([
                'nombre' => $data['nombre'],
                'idproductos' => $data['idproductos'],
                'idusuarios' => $data['idusuarios'],
                'cantidad' => $data['cantidad']
            ]);
    }

    public function eliminarUsuarios($id)
    {
        return ventas::where('id', $id)->delete();
    }
}
