<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class productos extends Model
{
    use SoftDeletes;

    protected $table = "productos";
    protected $fillable = ['id', 'nombre', 'cantidad', 'fechavenciomiento', 'lote', 'precio', 'idproveedor', 'estado'];


    public function carrito()
    {
        return $this->hasMany('App\carrito', 'idproductos', 'id');
    }

    public function proveedor()
    {
        return $this->belongsTo('App\proveedor', 'idproveedor', 'id');
    }
}
