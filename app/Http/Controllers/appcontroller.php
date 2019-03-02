<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\source\Ventas\Ventas;
use App\source\Usuarios\Usuarios;
use App\source\Proveedor\Proveedor;
use App\source\Productos\Productos;

class appcontroller extends Controller
{

    private $clientes;
    private $proveedores;
    private $productos;
    private $ventas;

    public function __construct()
    {
        $this->clientes = new Usuarios();
        $this->proveedores = new Proveedor();
        $this->productos = new Productos();
        $this->ventas = new Ventas();
    }

    public function inicio()
    {
        return view('inicio');
    }

    public function clientes()
    {
        return view('cliente')
            ->with('lista', $this->clientes->listarUsuarios());
    }

    public function productos()
    {
        return view('producto')
            ->with('proveedores', $this->proveedores->listarProveedor())
            ->with('productos', $this->productos->listarProductos());
    }

    public function proveedores()
    {
        return view('proveedores')
            ->with('lista', $this->proveedores->listarProveedor());
    }

    public function listarVentas()
    {
        return view('listarventas')
            ->with('ventas', $this->ventas->listarVenta());
    }

    public function ventas()
    {
        return view('ventas')
            ->with('productos', $this->productos->listarProductos())
            ->with('usuarios', $this->clientes->listarUsuarios());
    }
}
