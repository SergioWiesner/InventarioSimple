<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ventas extends Model
{
    use SoftDeletes;

    protected $table = "ventas";
    protected $fillable = ['id', 'idusuario', 'total'];

    public function usuarios()
    {
        return $this->belongsTo('App\usuarios', 'idusuario', 'id');
    }

    public function carrito()
    {
        return $this->hasMany('App\carrito', 'idventa', 'id');
    }


}
