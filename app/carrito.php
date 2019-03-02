<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class carrito extends Model
{
    use SoftDeletes;

    protected $table = "carrito";
    protected $fillable = ['idproductos', 'cantidad', 'subtotal', 'idventa'];

    public function productos()
    {
        return $this->belongsTo('App\productos', 'idproductos', 'id');
    }

    public function venta()
    {
        return $this->belongsTo('App\ventas', 'idventa', 'id');
    }
}
