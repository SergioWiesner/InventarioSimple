<?php

namespace App\source\Usuarios;

use App\source\Tools\Basics;
use App\usuarios as database;
use Illuminate\Support\Facades\DB;

class Usuarios
{
    private $usuario;

    public function __construct()
    {
        $this->usuario = new database();
    }

    public function crearUsuarios($data)
    {
        $this->usuario->nombre = $data['nombre'];
        return $this->usuario->save();
    }

    public function listarUsuarios()
    {
        return Basics::collectionToArray(database::all());
    }

    public function actualizarUsuarios($data, $id)
    {
        return DB::table('usuarios')
            ->where('id', $id)
            ->update(['nombre' => $data['nombre']]);
    }

    public function eliminarUsuarios($id)
    {
        return database::where('id', $id)->delete();
    }
}
