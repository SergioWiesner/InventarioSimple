<?php

namespace App\source\Productos;

use App\source\Tools\Basics;
use Illuminate\Support\Facades\DB;
use App\productos as database;

class Productos
{
    private $productos;

    public function __construct()
    {
        $this->productos = new database();
    }


    public function crearProductos($data)
    {
        $this->productos->nombre = $data['nombre'];
        $this->productos->cantidad = $data['cantidad'];
        $this->productos->fechavenciomiento = $data['fechavenciomiento'];
        $this->productos->lote = $data['lote'];
        $this->productos->precio = $data['precio'];
        $this->productos->idproveedor = $data['idproveedor'];
        $this->productos->estado = true;
        return $this->productos->save();
    }

    public function listarProductos()
    {
        return Basics::collectionToArray(database::with('proveedor')->get());
    }

    public function bucarProductos($id)
    {
        return Basics::collectionToArray(database::where('id', $id)->with('proveedor')->get());
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
        return database::where('id', $id)->delete();
    }

    public function descontarStock($id, $cantidad, $stock)
    {
        $estado = 1;
        if ($stock - $cantidad <= 0) {
            $estado = 0;
        }
        return DB::table('productos')
            ->where('id', $id)
            ->update([
                'cantidad' => $stock - $cantidad,
                'estado' => $estado
            ]);
    }

    public function sumarAStock($id, $cantidad, $stock)
    {
        return DB::table('productos')
            ->where('id', $id)
            ->update([
                'cantidad' => $stock + $cantidad,
                'estado' => 1
            ]);
    }
}
