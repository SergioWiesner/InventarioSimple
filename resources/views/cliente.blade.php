@extends('root')
@section('contenido')
    <div class="row">
        <div class="col-md-4">
            <h1>Agregar cliente</h1>
            <hr>
            <form action="{{route('guardrcliente')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="exampleFormControlInput1">Nombre</label>
                    <input type="text" class="form-control" name="nombre" id="exampleFormControlInput1"
                           placeholder="Nombre cliente">
                </div>
                <input type="submit" class="btn btn-primary btn-block" value="Agregar">
            </form>
        </div>
        <div class="col-md-8">
            <h1>Lista de clientes</h1>
            <hr>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @if(count($lista) > 0)
                    @for($a = 0; $a < count($lista); $a++)
                        <tr>
                            <th scope="row">{{$lista[$a]['id']}}</th>
                            <td>{{$lista[$a]['nombre']}}</td>
                            <td><a href="{{route('eliminarcliente', ['id' => $lista[$a]['id']])}}"><i
                                        class="fas fa-trash"></i> Eliminar</a></td>
                        </tr>
                    @endfor
                @endif
                </tbody>
            </table>
        </div>
    </div>

@endsection
