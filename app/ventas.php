<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ventas extends Model
{
    use SoftDeletes;

    protected $table = "ventas"
    protected $fillable = ['id', 'idproductos', 'idusuarios', 'cantidad'];

    public function usuarios()
    {
        return $this->belongsTo('App\usuarios', 'idusuarios', 'id');
    }

    public function productos()
    {
        return $this->belongsTo('App\productos', 'idproductos', 'id');
    }
}
