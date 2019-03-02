<?php

namespace App\source\Productos;

use Illuminate\Support\Facades\DB;
use \App\productos;

class Productos
{
    private $productos;

    public function __construct()
    {
        $this->productos = new productos();
    }


    public function crearProductos($data)
    {
        $this->productos->nombre = $data['nombre'];
        $this->productos->cantidad = $data['cantidad'];
        $this->productos->fechavenciomiento = $data['fechavenciomiento'];
        $this->productos->lote = $data['lote'];
        $this->productos->precio = $data['precio'];
        $this->productos->idproveedor = $data['idproveedor'];
        $this->productos->estado = $data['estado'];
        return $this->productos->save();
    }

    public function listarProductos()
    {
        return productos::all();
    }

    public function actualizarProductos($data, $id)
    {
        return DB::table('productos')
            ->where('id', $id)
            ->update([
                'nombre' => $data['nombre'],
                'cantidad' => $data['cantidad'],
                'fechavenciomiento' => $data['fechavenciomiento'],
                'lote' => $data['lote'],
                'precio' => $data['precio'],
                'idproveedor' => $data['idproveedor'],
                'estado' => $data['estado']
            ]);
    }

    public function eliminarProductos($id)
    {
        return productos::where('id', $id)->delete();
    }
}
