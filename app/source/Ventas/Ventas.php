<?php

namespace App\source\Ventas;

use App\source\Productos\Productos;
use App\source\Tools\Basics;
use Illuminate\Support\Facades\DB;
use App\ventas as database;
use Carbon\Carbon;
use App\carrito;
use PDF;


class Ventas
{
    private $ventas;
    private $carrito;
    private $productos;

    public function __construct()
    {
        $this->ventas = new database();
        $this->carrito = new carrito();
        $this->productos = new Productos();

    }

    public function crearVenta($data)
    {
        if (count($data['producto']) > 0) {
            $idventa = self::obtenerIdVenta($data['cliente'], $data['producto']);
            for ($c = 0; $c < count($data['producto']['id']); $c++) {
                self::agregarCarrito($data['producto']['id'][$c], $data['producto']['valorunidad'][$c], $data['producto']['cantidad'][$c], $data['producto']['stock'][$c], $idventa->id);
            }
        }
        $data['total'] = $idventa->total;

        $pdf = PDF::loadView('factura', ['data' => $data]);
        return $pdf->download('factura.pdf');
    }

    public function agregarCarrito($id, $valor, $cantidad, $stock, $idventa)
    {
        $this->productos->descontarStock($id, $cantidad, $stock);

        $this->carritoventa = new carrito();
        $this->carritoventa->idproductos = $id;
        $this->carritoventa->cantidad = $cantidad;
        $this->carritoventa->subtotal = $valor * $cantidad;
        $this->carritoventa->idventa = $idventa;
        $this->carritoventa->save();
    }

    public function listarVenta()
    {
        return self::formatVentas(Basics::collectionToArray(database::with('carrito.productos.proveedor')->with('usuarios')->get()));
    }

    public function actualizarVenta($data, $id)
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

    public function obtenerIdVenta($usuaro, $productos)
    {
        return database::create([
            'idusuario' => $usuaro,
            'total' => self::obtenerTotal($productos)
        ]);
    }

    public function obtenerTotal($productos)
    {
        $acumulado = 0;
        for ($a = 0; $a < count($productos['id']); $a++) {
            $acumulado += $productos['valorunidad'][$a] * $productos['cantidad'][$a];
        }
        if ($acumulado != 0) {
            return $acumulado;
        }
        return redirect()->back();
    }

    public function eliminarVenta($id)
    {
        $carrito = Basics::collectionToArray(carrito::where('idventa', $id)->with('productos')->get());
        for ($c = 0; $c < count($carrito); $c++) {
            $this->productos->sumarAStock($carrito[$c]['idproductos'], $carrito[$c]['cantidad'], $carrito[$c]['productos']['cantidad']);
        }
        database::where('id', $id)->delete();
        carrito::where('idventa', $id)->delete();
    }

    public function formatVentas($ventas)
    {
        $arr = [];
        $productos = [];
        for ($a = 0; $a < count($ventas); $a++) {
            for ($b = 0; $b < count($ventas[$a]['carrito']); $b++) {
                $productos[$b] = [
                    'nombre' => $ventas[$a]['carrito'][$b]['productos']['nombre'],
                    'proveedor' => $ventas[$a]['carrito'][$b]['productos']['proveedor']['nombreproveedor'],
                    'cantidad' => $ventas[$a]['carrito'][$b]['cantidad'],
                    'preciou' => $ventas[$a]['carrito'][$b]['productos']['precio'],
                    'total' => $ventas[$a]['carrito'][$b]['subtotal']
                ];
            }
            $arr[$a] = [
                'id' => $ventas[$a]['id'],
                'cliente' => $ventas[$a]['usuarios']['nombre'],
                'total' => $ventas[$a]['total'],
                'fecha' => new Carbon($ventas[$a]['created_at']),
                'comprador' => $ventas[$a]['usuarios']['nombre'],
                'productos' => $productos
            ];
        }
        return $arr;
    }

}
