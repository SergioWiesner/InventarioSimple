<?php

namespace App\source\Usuarios;

use App\usuarios;
use Illuminate\Support\Facades\DB;

class Usuarios
{
    private $usuario;

    public function __construct()
    {
        $this->usuario = new usuarios();
    }

    public function crearUsuarios($data)
    {
        $this->usuario->nombre = $data['nombre'];
        return $this->usuario->save();
    }

    public function listarUsuarios()
    {
        return usuarios::all();
    }

    public function actualizarUsuarios($data, $id)
    {
        return DB::table('usuarios')
            ->where('id', $id)
            ->update(['nombre' => $data['nombre']]);
    }

    public function eliminarUsuarios($id)
    {
        return usuarios::where('id', $id)->delete();
    }
}
