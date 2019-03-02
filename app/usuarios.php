<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class usuarios extends Model
{
    use SoftDeletes;

    protected $table = "usuarios"
    protected $fillable = ['id', 'nombre'];

    public function ventas()
    {
        return $this->hasMany('App\ventas', 'idusuarios', 'id');
    }
}
