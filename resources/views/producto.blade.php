@extends('root')
@section('contenido')
    <div class="row">
        <div class="col-md-4">
            <h1>Agregar producto</h1>
            <hr>
            <form action="{{route('creacionproductos')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="exampleFormControlInput1">Nombre</label>
                    <input type="text" name="nombre" class="form-control" id="exampleFormControlInput1"
                           placeholder="Producto">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Cantidad</label>
                    <input type="number" name="cantidad" class="form-control" id="exampleFormControlInput1"
                           placeholder="cantidad">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Fecha de venciomiento</label>
                    <input type="date" name="fechavenciomiento" class="form-control" id="exampleFormControlInput1"
                           placeholder="fecha de venciomiento">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Lote</label>
                    <input type="number" name="lote" class="form-control" id="exampleFormControlInput1"
                           placeholder="lote">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Precio</label>
                    <input type="number" name="precio" class="form-control" id="exampleFormControlInput1"
                           placeholder="precio">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlSelect2">Proveedor</label>
                    <select name="idproveedor" class="form-control" id="exampleFormControlSelect2">
                        <option></option>
                        @if(count($proveedores) > 0)
                            @for($a = 0; $a < count($proveedores); $a++)
                                <option
                                    value="{{$proveedores[$a]['id']}}">{{$proveedores[$a]['nombreproveedor']}}</option>
                            @endfor
                        @endif

                    </select>
                </div>
                <input type="submit" class="btn btn-primary btn-block" value="Agregar">
            </form>
        </div>
        <div class="col-md-8">
            <h1>Lista de productos</h1>
            <hr>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Lote</th>
                    <th scope="col">Proveedor</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Fecha de vencimiento</th>
                    <th scope="col">Inventario</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @if(count($productos) > 0)
                    @for($a = 0; $a < count($productos); $a++)
                        <tr>
                            <th scope="row">{{$productos[$a]['nombre']}}</th>
                            <td>{{$productos[$a]['cantidad']}}</td>
                            <td>{{$productos[$a]['lote']}}</td>
                            <td>{{$productos[$a]['proveedor']['nombreproveedor']}}</td>
                            <td>${{number_format($productos[$a]['precio'])}}</td>
                            <td>{{date_format(date_create($productos[$a]['fechavenciomiento']), 'd-m-y')}}</td>
                            <td>@if($productos[$a]['estado'] == 1) Activo @else Desactivado @endif</td>
                            <td><a href="{{route('eliminarproductos', ['id' => $productos[$a]['id']])}}"><i
                                        class="fas fa-trash"></i> Eliminar</a></a></td>
                        </tr>
                    @endfor
                @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
