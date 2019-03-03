<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'appcontroller@inicio');
Route::get('/clientes/', 'appcontroller@clientes')->name('clientes');
Route::get('/productos/', 'appcontroller@productos')->name('productos');
Route::get('/proveedores/', 'appcontroller@proveedores')->name('proveedores');
Route::get('/ventas/', 'appcontroller@ventas')->name('ventas');
Route::get('/ventas/listar', 'appcontroller@listarVentas')->name('listarventas');

Route::post('/clientes/guardar', 'usuarioscontroller@store')->name('guardrcliente');
Route::post('/proveedor/guardar', 'proveedorcontroller@store')->name('guardrproveedor');
Route::post('/productos/guardar', 'productoscontroller@store')->name('creacionproductos');
Route::post('/venta/guardar', 'ventascontroller@store')->name('crearventa');

Route::get('/clientes/eliminar/{id}', 'usuarioscontroller@destroy')->name('eliminarcliente');
Route::get('/proveedor/eliminar/{id}', 'proveedorcontroller@destroy')->name('eliminarproveedor');
Route::get('/eliminar/venta/{id}', 'ventascontroller@destroy')->name('eliminarventas');
Route::get('/eliminar/productos/{id}', 'productoscontroller@destroy')->name('eliminarproductos');

Route::get('/productos/bucar/{id}', 'productoscontroller@show');
