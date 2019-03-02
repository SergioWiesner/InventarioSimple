<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class proveedor extends Model
{
    use SoftDeletes;

    protected $table = "proveedor"
    protected $fillable = ['id', 'nombreproveedor'];

    public function productos()
    {
        return $this->hasMany('App\productos', 'idproveedor', 'id');
    }
}
