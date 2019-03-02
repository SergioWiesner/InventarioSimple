@extends('root')
@section('contenido')
    <div class="row">
        <div class="col-md-12">
            <h1>Ventas hechas</h1>
            <hr>
        </div>
        <div class="col-md-12">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Cliente</th>
                    <th scope="col">Total</th>
                    <th scope="col">Fecha</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @for($a = 0; $a < count($ventas); $a++)
                    <tr>
                        <th scope="row">{{$a+1}}</th>
                        <td>{{$ventas[$a]['cliente']}}</td>
                        <td>${{number_format($ventas[$a]['total'])}}</td>
                        <td>{{$ventas[$a]['fecha']->toFormattedDateString()}}</td>
                        <td><a href="#!" data-toggle="modal" data-target=".bd-example-modal-xl{{$a+1}}"><i
                                    class="fas fa-eye"></i></a>
                            <a href="{{route('eliminarventas', ['id' => $ventas[$a]['id']])}}"><i
                                    class="fas fa-trash"></i></a>
                            <div class="modal fade bd-example-modal-xl{{$a+1}}" tabindex="-1" role="dialog"
                                 aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Producto</th>
                                                <th scope="col">Proveedor</th>
                                                <th scope="col">Cantidad</th>
                                                <th scope="col">Precio u</th>
                                                <th scope="col">Total</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @for($c = 0; $c < count($ventas[$a]['productos']); $c++)
                                                <tr>
                                                    <th scope="row">{{$c+1}}</th>
                                                    <td>{{$ventas[$a]['productos'][$c]['nombre']}}</td>
                                                    <td>{{$ventas[$a]['productos'][$c]['proveedor']}}</td>
                                                    <td>{{$ventas[$a]['productos'][$c]['cantidad']}}</td>
                                                    <td>${{number_format($ventas[$a]['productos'][$c]['preciou'])}}</td>
                                                    <td>${{number_format($ventas[$a]['productos'][$c]['total'])}}</td>
                                                </tr>
                                            @endfor
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endfor
                </tbody>
            </table>
        </div>
    </div>
@endsection
